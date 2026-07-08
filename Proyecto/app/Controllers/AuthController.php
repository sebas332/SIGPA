<?php
/**
 * Controlador AuthController
 * Gestiona el inicio y cierre de sesión de usuarios, y asignación de roles.
 */
class AuthController extends BaseController {
    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = $this->model('Usuario');
    }

    /**
     * Muestra el formulario de login o procesa la autenticación
     */
    public function login() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Si ya está logueado, redirigir al dashboard
        if (isset($_SESSION['user_id'])) {
            $this->redirect('dashboard/index');
        }

        $data = [
            'username' => '',
            'password' => '',
            'error' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data['username'] = trim($_POST['username'] ?? '');
            $data['password'] = trim($_POST['password'] ?? '');

            if (empty($data['username']) || empty($data['password'])) {
                $data['error'] = 'Por favor ingresa tu documento y contraseña.';
            } elseif (!preg_match('/^[0-9]{1,10}$/', $data['username'])) {
                $data['error'] = 'El documento de identidad debe contener solo números y máximo 10 dígitos.';
            } elseif (strlen($data['password']) < 8) {
                $data['error'] = 'La contraseña debe tener al menos 8 caracteres.';
            } else {
                $user = $this->usuarioModel->authenticate($data['username'], $data['password']);

                if ($user) {
                    // Prevenir ataques de fijación de sesión (Session Fixation)
                    session_regenerate_id(true);

                    // Obtener los roles del usuario
                    $rolesObj = $this->usuarioModel->getRoles($user->id_usuario);
                    $roles = [];
                    foreach ($rolesObj as $rol) {
                        $roles[] = $rol->nombre_rol;
                    }

                    // Iniciar sesión y asignar variables
                    $_SESSION['user_id'] = $user->id_usuario;
                    $_SESSION['user_name'] = $user->nombre . ' ' . $user->apellido;
                    $_SESSION['user_user'] = $user->usuario;
                    $_SESSION['user_titulacion'] = $user->titulacion;
                    $_SESSION['user_roles'] = $roles;
                    $_SESSION['current_role'] = !empty($roles) ? $roles[0] : 'Aprendiz';
                    $_SESSION['flash_success'] = '¡Bienvenido, ' . $_SESSION['user_name'] . '! Has iniciado sesión como ' . $_SESSION['current_role'] . '.';

                    // Auditoría de Inicio de Sesión
                    AuditLogger::log('Inicio de Sesión', 'usuarios', $user->id_usuario, 'Inició sesión con rol: ' . $_SESSION['current_role']);

                    $this->redirect('dashboard/index');
                } else {
                    $data['error'] = 'Credenciales incorrectas. Por favor verifica.';
                }
            }
        }

        // Cargar vista de login
        $this->render('auth/login', $data);
    }

    /**
     * Permite alternar la vista activa si el usuario tiene varios roles
     */
    public function switchRole() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $newRole = $_GET['role'] ?? '';
        if (isset($_SESSION['user_roles']) && in_array($newRole, $_SESSION['user_roles'])) {
            $_SESSION['current_role'] = $newRole;
            $_SESSION['flash_success'] = 'Vista cambiada exitosamente al rol de ' . $newRole . '.';
            
            // Auditoría de Cambio de Rol
            AuditLogger::log('Cambio de Rol', 'usuarios', $_SESSION['user_id'], 'Cambió de rol activo a: ' . $newRole);
        }
        $this->redirect('dashboard/index');
    }

    /**
     * Cerrar sesión
     */
    /**
     * Cerrar sesión
     */
    public function logout() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // Auditoría de Cierre de Sesión (antes de limpiar $_SESSION)
        if (isset($_SESSION['user_id'])) {
            AuditLogger::log('Cierre de Sesión', 'usuarios', $_SESSION['user_id'], 'Cerró sesión del sistema');
        }

        // Limpiar todas las variables de sesión
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
        header('Location: ' . URLROOT . '/index.php?route=auth/login');
        exit;
    }

    /**
     * Procesa la solicitud AJAX para enviar el correo de recuperación
     */
    public function forgotPassword() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
            exit;
        }

        header('Content-Type: application/json');
        $email = trim($_POST['correo'] ?? '');
        $localResetLink = null;

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => 'Por favor ingresa un correo electrónico válido.']);
            exit;
        }

        $user = $this->usuarioModel->findByEmail($email);

        if ($user) {
            $token = bin2hex(random_bytes(32));
            $expiry = date('Y-m-d H:i:s', time() + 900); // 15 minutos

            if ($this->usuarioModel->saveResetToken($user->id_usuario, $token, $expiry)) {
                $resetLink = $this->buildResetLink($token);

                if ($this->isSmtpConfigured()) {
                    require_once APPROOT . '/libraries/PHPMailer/Exception.php';
                    require_once APPROOT . '/libraries/PHPMailer/PHPMailer.php';
                    require_once APPROOT . '/libraries/PHPMailer/SMTP.php';

                    $emailSent = $this->sendRecoveryEmail($user->correo, $user->nombre . ' ' . $user->apellido, $resetLink);
                    if (!$emailSent && $this->isLocalRequest()) {
                        $localResetLink = $resetLink;
                    }
                } elseif ($this->isLocalRequest()) {
                    $localResetLink = $resetLink;
                }
            }
        }

        $response = [
            'success' => true,
            'message' => 'Si el correo está registrado, recibirás un enlace para recuperar tu contraseña.'
        ];

        if ($localResetLink) {
            $response['message'] = 'Modo local: SMTP no está configurado. Usa el enlace temporal para restablecer la contraseña.';
            $response['reset_link'] = $localResetLink;
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Muestra la vista de restablecimiento de contraseña si el token es válido
     */
    public function resetPassword() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $token = $_GET['token'] ?? '';

        if (empty($token)) {
            $_SESSION['flash_error'] = 'El enlace de recuperación no es válido o ha expirado. Solicita uno nuevo.';
            $this->redirect('auth/login');
        }

        $user = $this->usuarioModel->findByResetToken($token);

        if (!$user) {
            $_SESSION['flash_error'] = 'El enlace de recuperación no es válido o ha expirado. Solicita uno nuevo.';
            $this->redirect('auth/login');
        }

        $this->render('auth/reset_password', [
            'token' => $token,
            'usuario' => $user
        ], 'layout');
    }

    /**
     * Procesa la actualización de la contraseña
     */
    public function updatePassword() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $_SESSION['flash_error'] = 'Método no permitido.';
            $this->redirect('auth/login');
        }

        $token = $_POST['token'] ?? '';
        $password = $_POST['contrasena'] ?? '';
        $passwordConfirm = $_POST['contrasena_confirm'] ?? '';

        if (empty($token)) {
            $_SESSION['flash_error'] = 'Acceso inválido.';
            $this->redirect('auth/login');
        }

        $user = $this->usuarioModel->findByResetToken($token);
        if (!$user) {
            $_SESSION['flash_error'] = 'El token no es válido o ya expiró.';
            $this->redirect('auth/login');
        }

        if ($password === '') {
            $_SESSION['flash_error'] = 'La nueva contraseña no puede estar vacía.';
            $this->redirect('auth/resetPassword&token=' . urlencode($token));
        }

        if ($password !== $passwordConfirm) {
            $_SESSION['flash_error'] = 'Las contraseñas no coinciden.';
            $this->redirect('auth/resetPassword&token=' . urlencode($token));
        }

        if (strlen($password) < 8) {
            $_SESSION['flash_error'] = 'La contraseña debe tener al menos 8 caracteres.';
            $this->redirect('auth/resetPassword&token=' . urlencode($token));
        }
        if (!preg_match('/[A-Z]/', $password)) {
            $_SESSION['flash_error'] = 'Debe contener al menos una letra mayúscula.';
            $this->redirect('auth/resetPassword&token=' . urlencode($token));
        }
        if (!preg_match('/[a-z]/', $password)) {
            $_SESSION['flash_error'] = 'Debe contener al menos una letra minúscula.';
            $this->redirect('auth/resetPassword&token=' . urlencode($token));
        }
        if (!preg_match('/[0-9]/', $password)) {
            $_SESSION['flash_error'] = 'Debe contener al menos un número.';
            $this->redirect('auth/resetPassword&token=' . urlencode($token));
        }
        if (!preg_match('/[!@#$%^&*(),.?":{}|<>_\-\[\]]/', $password)) {
            $_SESSION['flash_error'] = 'Debe contener al menos un carácter especial.';
            $this->redirect('auth/resetPassword&token=' . urlencode($token));
        }

        // Cifrado mediante PASSWORD_DEFAULT según requerimientos
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if ($this->usuarioModel->updatePasswordAndClearToken($user->id_usuario, $hashedPassword)) {
            $_SESSION['flash_success'] = 'Tu contraseña fue restablecida correctamente. Ya puedes iniciar sesión con tu nueva contraseña.';
        } else {
            $_SESSION['flash_error'] = 'No fue posible actualizar la contraseña. Inténtalo más tarde.';
        }

        $this->redirect('auth/login');
    }

    /**
     * Helper para enviar el correo mediante PHPMailer
     */
    private function sendRecoveryEmail($email, $nombre, $resetLink) {
        $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = SMTP_HOST;
            $mail->SMTPAuth   = true;
            $mail->Username   = SMTP_USER;
            $mail->Password   = SMTP_PASS;
            $mail->SMTPSecure = (SMTP_SECURE === 'ssl') ? \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS : \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = SMTP_PORT;
            $mail->CharSet    = 'UTF-8';

            $mail->setFrom(SMTP_USER, SMTP_FROM_NAME);
            $mail->addAddress($email, $nombre);

            // Incoporación de imagen incrustada de logo SIGPA
            $logoPath = APPROOT . '/../public/logo-sigpa.png';
            if (file_exists($logoPath)) {
                $mail->addEmbeddedImage($logoPath, 'logo_sigpa');
            }

            $mail->isHTML(true);
            $mail->Subject = 'Recuperar Contraseña - SIGPA';
            $safeName = htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8');
            $safeResetLink = htmlspecialchars($resetLink, ENT_QUOTES, 'UTF-8');

            $mail->Body = '
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <style>
                    body { font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f6f9; color: #333333; margin: 0; padding: 0; }
                    .email-container { max-width: 600px; margin: 20px auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.06); border: 1px solid #e1e5eb; }
                    .email-header { background-color: #005026; padding: 30px; text-align: center; color: #ffffff; }
                    .email-header img { width: 150px; height: auto; margin-bottom: 10px; }
                    .email-header h1 { margin: 0; font-size: 1.6rem; font-weight: 700; }
                    .email-body { padding: 40px 30px; line-height: 1.6; }
                    .email-body h2 { color: #005026; font-size: 1.3rem; margin-top: 0; }
                    .btn-container { text-align: center; margin: 30px 0; }
                    .btn-recovery { background-color: #39A900; color: #ffffff !important; text-decoration: none; padding: 12px 30px; font-weight: 700; border-radius: 8px; font-size: 0.95rem; display: inline-block; box-shadow: 0 4px 10px rgba(57, 169, 0, 0.25); }
                    .btn-recovery:hover { background-color: #007832; }
                    .email-footer { background-color: #fafbfc; padding: 20px; text-align: center; font-size: 0.75rem; color: #868e96; border-top: 1px solid #f1f3f5; }
                    .email-footer a { color: #868e96; text-decoration: none; }
                </style>
            </head>
            <body>
                <div class="email-container">
                    <div class="email-header">
                        ' . (file_exists($logoPath) ? '<img src="cid:logo_sigpa" alt="Logo SIGPA">' : '') . '
                        <h1>Sistema de Gestión Académica</h1>
                        <div style="font-size: 0.85rem; opacity: 0.8; margin-top: 5px;">SGA SENA</div>
                    </div>
                    <div class="email-body">
                        <h2>Hola, ' . $safeName . '</h2>
                        <p>Se ha solicitado la recuperación de contraseña para tu cuenta en el sistema SIGPA. Para restablecerla, haz clic en el siguiente botón:</p>
                        <div class="btn-container">
                            <a href="' . $safeResetLink . '" class="btn-recovery">Restablecer Contraseña</a>
                        </div>
                        <p style="color: #6c757d; font-size: 0.82rem;">Este enlace es válido por 15 minutos. Si no solicitaste este cambio, puedes ignorar este correo de forma segura.</p>
                        <hr style="border: 0; border-top: 1px solid #e9ecef; margin: 30px 0;">
                        <p style="font-size: 0.78rem; color: #868e96;">Si el botón no funciona, copia y pega la siguiente URL en tu navegador:<br>' . $safeResetLink . '</p>
                    </div>
                    <div class="email-footer">
                        SGA SENA © ' . date('Y') . ' • Todos los derechos reservados.<br>
                        Ministerio del Trabajo • Colombia
                    </div>
                </div>
            </body>
            </html>';

            $mail->send();
            return true;
        } catch (\Exception $e) {
            error_log("Error al enviar correo: " . $mail->ErrorInfo);
            return false;
        }
    }

    /**
     * Construye la URL absoluta para restablecer contraseña.
     */
    private function buildResetLink($token) {
        return URLROOT . '/index.php?route=auth/resetPassword&token=' . urlencode($token);
    }

    /**
     * Valida si las constantes SMTP fueron reemplazadas por credenciales reales.
     */
    private function isSmtpConfigured() {
        return defined('SMTP_HOST') && defined('SMTP_USER') && defined('SMTP_PASS')
            && SMTP_HOST !== ''
            && SMTP_USER !== ''
            && SMTP_PASS !== ''
            && SMTP_USER !== 'tu_correo@gmail.com'
            && SMTP_PASS !== 'tu_contraseña_de_aplicación';
    }

    /**
     * Permite mostrar enlace de prueba solo en entorno local.
     */
    private function isLocalRequest() {
        $host = $_SERVER['HTTP_HOST'] ?? '';
        return strpos($host, 'localhost') !== false
            || strpos($host, '127.0.0.1') !== false
            || strpos($host, '::1') !== false;
    }
}

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
        }
        $this->redirect('dashboard/index');
    }

    /**
     * Cerrar sesión
     */
    public function logout() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
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
}

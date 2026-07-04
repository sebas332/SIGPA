<?php
/**
 * Perfil personal del usuario autenticado.
 */
class PerfilController extends BaseController {
    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = $this->model('Usuario');
    }

    public function index() {
        $this->requireLogin();
        $usuario = $this->usuarioModel->find((int) $_SESSION['user_id']);

        if (!$usuario) {
            $_SESSION['flash_error'] = 'No fue posible cargar tu perfil.';
            $this->redirect('dashboard/index');
        }

        if (empty($_SESSION['profile_csrf'])) {
            $_SESSION['profile_csrf'] = bin2hex(random_bytes(32));
        }

        $this->render('perfil/index', [
            'titulo' => 'Mi perfil',
            'usuario' => $usuario,
            'roles' => $this->usuarioModel->getRoles($usuario->id_usuario),
            'fotoPerfil' => $this->profilePhotoUrl($usuario->id_usuario),
            'current_role' => $_SESSION['current_role'] ?? 'Aprendiz',
            'csrfToken' => $_SESSION['profile_csrf']
        ]);
    }

    public function update() {
        $this->requireLogin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('perfil/index');
        }

        $token = $_POST['csrf_token'] ?? '';
        if (empty($_SESSION['profile_csrf']) || !hash_equals($_SESSION['profile_csrf'], $token)) {
            $_SESSION['flash_error'] = 'La sesión del formulario expiró. Intenta nuevamente.';
            $this->redirect('perfil/index');
        }

        $id = (int) $_SESSION['user_id'];
        $nombre = trim($_POST['nombre'] ?? '');
        $apellido = trim($_POST['apellido'] ?? '');
        $telefono = trim($_POST['telefono'] ?? '');
        $correo = trim($_POST['correo'] ?? '');
        $titulacion = trim($_POST['titulacion'] ?? '');
        $password = $_POST['contrasena'] ?? '';

        // Validaciones del servidor
        if ($nombre === '' || !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]{2,50}$/u', $nombre)) {
            $_SESSION['flash_error'] = 'El nombre es obligatorio (2-50 caracteres, solo letras, espacios y tildes).';
            $this->redirect('perfil/index');
        }

        if ($apellido === '' || !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]{2,50}$/u', $apellido)) {
            $_SESSION['flash_error'] = 'El apellido es obligatorio (2-50 caracteres, solo letras, espacios y tildes).';
            $this->redirect('perfil/index');
        }

        $correo = strtolower(str_replace(' ', '', $correo));
        if ($correo === '' || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['flash_error'] = 'Formato de correo electrónico no válido.';
            $this->redirect('perfil/index');
        }

        if ($this->usuarioModel->emailExistsForOtherUser($correo, $id)) {
            $_SESSION['flash_error'] = 'El correo electrónico ya está registrado por otro usuario.';
            $this->redirect('perfil/index');
        }

        if ($telefono === '' || !preg_match('/^[0-9]{10}$/', $telefono)) {
            $_SESSION['flash_error'] = 'El teléfono móvil debe tener exactamente 10 dígitos numéricos.';
            $this->redirect('perfil/index');
        }

        if ($titulacion === '' || !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s\.\-]{1,80}$/u', $titulacion)) {
            $_SESSION['flash_error'] = 'La titulación es obligatoria (máximo 80 caracteres, solo letras, puntos y guiones).';
            $this->redirect('perfil/index');
        }

        $passwordActual = $_POST['contrasena_actual'] ?? '';
        $passwordConfirm = $_POST['contrasena_confirm'] ?? '';
        $passwordToUpdate = '';

        if ($password !== '') {
            if ($passwordActual === '') {
                $_SESSION['flash_error'] = 'Debes ingresar tu contraseña actual para realizar el cambio.';
                $this->redirect('perfil/index');
            }

            $usuarioDb = $this->usuarioModel->find($id);
            if (!$usuarioDb) {
                $_SESSION['flash_error'] = 'No fue posible verificar tus datos.';
                $this->redirect('perfil/index');
            }

            $isCurrentValid = ($passwordActual === $usuarioDb->contraseña || password_verify($passwordActual, $usuarioDb->contraseña));
            if (!$isCurrentValid) {
                $_SESSION['flash_error'] = 'La contraseña actual es incorrecta.';
                $this->redirect('perfil/index');
            }

            if ($password !== $passwordConfirm) {
                $_SESSION['flash_error'] = 'La nueva contraseña y la confirmación no coinciden.';
                $this->redirect('perfil/index');
            }

            if ($password === $passwordActual) {
                $_SESSION['flash_error'] = 'La nueva contraseña debe ser diferente de la contraseña actual.';
                $this->redirect('perfil/index');
            }

            if (strlen($password) < 8) {
                $_SESSION['flash_error'] = 'La nueva contraseña debe tener al menos 8 caracteres.';
                $this->redirect('perfil/index');
            }
            if (!preg_match('/[A-Z]/', $password)) {
                $_SESSION['flash_error'] = 'La nueva contraseña debe contener al menos una letra mayúscula.';
                $this->redirect('perfil/index');
            }
            if (!preg_match('/[a-z]/', $password)) {
                $_SESSION['flash_error'] = 'La nueva contraseña debe contener al menos una letra minúscula.';
                $this->redirect('perfil/index');
            }
            if (!preg_match('/[0-9]/', $password)) {
                $_SESSION['flash_error'] = 'La nueva contraseña debe contener al menos un número.';
                $this->redirect('perfil/index');
            }
            if (!preg_match('/[!@#$%^&*(),.?":{}|<>_\-\[\]]/', $password)) {
                $_SESSION['flash_error'] = 'La nueva contraseña debe contener al menos un carácter especial.';
                $this->redirect('perfil/index');
            }

            $passwordToUpdate = password_hash($password, PASSWORD_BCRYPT);
        }

        try {
            if (!empty($_FILES['foto']['name'])) {
                $this->saveProfilePhoto($id, $_FILES['foto']);
            }

            $updated = $this->usuarioModel->updateProfile($id, [
                'nombre' => $nombre,
                'apellido' => $apellido,
                'telefono' => $telefono,
                'correo' => $correo,
                'titulacion' => $titulacion,
                'contrasena' => $passwordToUpdate
            ]);

            if (!$updated) {
                throw new RuntimeException('No fue posible actualizar los datos.');
            }

            $_SESSION['user_name'] = $nombre . ' ' . $apellido;
            $_SESSION['user_titulacion'] = $titulacion;
            $_SESSION['flash_success'] = 'Tu perfil fue actualizado correctamente.';
        } catch (Throwable $e) {
            $_SESSION['flash_error'] = $e->getMessage();
        }

        $this->redirect('perfil/index');
    }

    private function saveProfilePhoto($userId, $file) {
        if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
            return;
        }
        if (($file['size'] ?? 0) > 5 * 1024 * 1024) {
            throw new RuntimeException('La fotografía no puede superar los 5 MB.');
        }

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($file['tmp_name']);
        $extensions = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
        if (!isset($extensions[$mime])) {
            throw new RuntimeException('Utiliza una imagen JPG, PNG o WEBP.');
        }

        $directory = dirname(__DIR__, 2) . '/public/uploads/profile';
        if (!is_dir($directory) && !mkdir($directory, 0755, true)) {
            throw new RuntimeException('No fue posible preparar el almacenamiento de imágenes.');
        }

        // Obtener usuario para eliminar su foto anterior
        $db = Database::getInstance();
        $db->query("SELECT foto FROM usuarios WHERE id_usuario = :id");
        $db->bind(':id', (int) $userId);
        $userObj = $db->single();

        if ($userObj && !empty($userObj->foto)) {
            $oldPath = $directory . '/' . $userObj->foto;
            if (is_file($oldPath)) {
                unlink($oldPath);
            }
        }

        $newFileName = 'profile_' . (int) $userId . '_' . uniqid() . '.' . $extensions[$mime];
        $destination = $directory . '/' . $newFileName;
        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            throw new RuntimeException('No fue posible guardar la fotografía.');
        }

        // Actualizar en base de datos
        $db->query("UPDATE usuarios SET foto = :foto WHERE id_usuario = :id");
        $db->bind(':foto', $newFileName);
        $db->bind(':id', (int) $userId);
        $db->execute();
    }

    private function profilePhotoUrl($userId) {
        $usuario = $this->usuarioModel->find((int) $userId);
        if ($usuario && !empty($usuario->foto)) {
            $filePath = dirname(__DIR__, 2) . '/public/uploads/profile/' . $usuario->foto;
            if (is_file($filePath)) {
                return ASSETROOT . '/uploads/profile/' . rawurlencode($usuario->foto) . '?v=' . filemtime($filePath);
            }
        }
        return null;
    }

    /**
     * Endpoint AJAX para subir la foto de perfil inmediatamente.
     */
    public function uploadFotoAjax() {
        $this->requireLogin();
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
            exit;
        }

        $userId = (int) $_SESSION['user_id'];
        $file = $_FILES['foto'] ?? null;

        if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
            echo json_encode(['success' => false, 'message' => 'No se recibió ningún archivo o hubo un error al subirlo.']);
            exit;
        }

        // Validar tamaño (máximo 5 MB)
        if ($file['size'] > 5 * 1024 * 1024) {
            echo json_encode(['success' => false, 'message' => 'La imagen no puede superar los 5 MB.']);
            exit;
        }

        // Validar tipo MIME
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($file['tmp_name']);
        $extensions = [
            'image/jpeg' => 'jpg',
            'image/jpg'  => 'jpg',
            'image/png'  => 'png',
            'image/webp' => 'webp'
        ];

        if (!isset($extensions[$mime])) {
            echo json_encode(['success' => false, 'message' => 'Formato no permitido. Utilice JPG, JPEG, PNG o WEBP.']);
            exit;
        }

        // Carpeta destino
        $directory = dirname(__DIR__, 2) . '/public/uploads/profile';
        if (!is_dir($directory) && !mkdir($directory, 0755, true)) {
            echo json_encode(['success' => false, 'message' => 'No fue posible crear la carpeta de almacenamiento.']);
            exit;
        }

        // Obtener usuario para eliminar su foto anterior si existe
        $db = Database::getInstance();
        $db->query("SELECT foto FROM usuarios WHERE id_usuario = :id");
        $db->bind(':id', $userId);
        $userObj = $db->single();

        if ($userObj && !empty($userObj->foto)) {
            $oldPath = $directory . '/' . $userObj->foto;
            if (is_file($oldPath)) {
                unlink($oldPath);
            }
        }

        // Generar nombre único para evitar duplicados
        $newFileName = 'profile_' . $userId . '_' . uniqid() . '.' . $extensions[$mime];
        $destination = $directory . '/' . $newFileName;

        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            echo json_encode(['success' => false, 'message' => 'No fue posible guardar el archivo en el servidor.']);
            exit;
        }

        // Actualizar en base de datos
        $db->query("UPDATE usuarios SET foto = :foto WHERE id_usuario = :id");
        $db->bind(':foto', $newFileName);
        $db->bind(':id', $userId);

        if ($db->execute()) {
            $newUrl = ASSETROOT . '/uploads/profile/' . rawurlencode($newFileName) . '?v=' . time();
            echo json_encode(['success' => true, 'newUrl' => $newUrl]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar la base de datos.']);
        }
        exit;
    }

    /**
     * Endpoint AJAX para comprobar la existencia del correo electrónico.
     */
    public function checkEmailAjax() {
        $this->requireLogin();
        header('Content-Type: application/json');
        
        $email = trim($_GET['email'] ?? '');
        $userId = (int) $_SESSION['user_id'];
        
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['valid' => false, 'message' => 'Formato de correo no válido.']);
            exit;
        }
        
        $exists = $this->usuarioModel->emailExistsForOtherUser($email, $userId);
        if ($exists) {
            echo json_encode(['valid' => false, 'message' => 'El correo electrónico ya está registrado por otro usuario.']);
        } else {
            echo json_encode(['valid' => true]);
        }
        exit;
    }
}

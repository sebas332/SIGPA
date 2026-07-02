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

        if ($nombre === '' || $apellido === '' || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['flash_error'] = 'Revisa el nombre, apellido y correo electrónico.';
            $this->redirect('perfil/index');
        }
        if ($password !== '' && strlen($password) < 8) {
            $_SESSION['flash_error'] = 'La nueva contraseña debe tener al menos 8 caracteres.';
            $this->redirect('perfil/index');
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
                'contrasena' => $password !== '' ? password_hash($password, PASSWORD_BCRYPT) : ''
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
            throw new RuntimeException('No fue posible cargar la fotografía.');
        }
        if (($file['size'] ?? 0) > 3 * 1024 * 1024) {
            throw new RuntimeException('La fotografía no puede superar los 3 MB.');
        }

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($file['tmp_name']);
        $extensions = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
        if (!isset($extensions[$mime])) {
            throw new RuntimeException('Utiliza una imagen JPG, PNG o WEBP.');
        }

        $directory = dirname(__DIR__, 2) . '/public/uploads/profiles';
        if (!is_dir($directory) && !mkdir($directory, 0755, true)) {
            throw new RuntimeException('No fue posible preparar el almacenamiento de imágenes.');
        }

        foreach (glob($directory . '/user_' . (int) $userId . '.*') ?: [] as $oldPhoto) {
            if (is_file($oldPhoto)) unlink($oldPhoto);
        }

        $destination = $directory . '/user_' . (int) $userId . '.' . $extensions[$mime];
        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            throw new RuntimeException('No fue posible guardar la fotografía.');
        }
    }

    private function profilePhotoUrl($userId) {
        $directory = dirname(__DIR__, 2) . '/public/uploads/profiles';
        $matches = glob($directory . '/user_' . (int) $userId . '.*') ?: [];
        return !empty($matches) ? ASSETROOT . '/uploads/profiles/' . rawurlencode(basename($matches[0])) . '?v=' . filemtime($matches[0]) : null;
    }
}

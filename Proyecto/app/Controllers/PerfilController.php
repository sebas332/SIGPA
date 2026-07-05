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
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
            exit;
        }

        $token = $_POST['csrf_token'] ?? '';
        if (empty($_SESSION['profile_csrf']) || !hash_equals($_SESSION['profile_csrf'], $token)) {
            echo json_encode(['success' => false, 'message' => 'La sesión del formulario expiró o es inválida. Intenta nuevamente.']);
            exit;
        }

        $id = (int) $_SESSION['user_id'];
        $usuarioDb = $this->usuarioModel->find($id);
        if (!$usuarioDb) {
            echo json_encode(['success' => false, 'message' => 'No fue posible verificar tus datos.']);
            exit;
        }

        $action = $_POST['action'] ?? 'personal';

        if ($action === 'personal') {
            $fieldsToUpdate = [];

            // 1. Nombre
            if (isset($_POST['nombre'])) {
                $nombre = trim($_POST['nombre']);
                if ($nombre !== $usuarioDb->nombre) {
                    if ($nombre === '' || !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]{2,50}$/u', $nombre)) {
                        echo json_encode(['success' => false, 'message' => 'El nombre es obligatorio (2-50 caracteres, solo letras, espacios y tildes).']);
                        exit;
                    }
                    $fieldsToUpdate['nombre'] = $nombre;
                }
            }

            // 2. Apellido
            if (isset($_POST['apellido'])) {
                $apellido = trim($_POST['apellido']);
                if ($apellido !== $usuarioDb->apellido) {
                    if ($apellido === '' || !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]{2,50}$/u', $apellido)) {
                        echo json_encode(['success' => false, 'message' => 'El apellido es obligatorio (2-50 caracteres, solo letras, espacios y tildes).']);
                        exit;
                    }
                    $fieldsToUpdate['apellido'] = $apellido;
                }
            }

            // 3. Correo
            if (isset($_POST['correo'])) {
                $correo = trim($_POST['correo']);
                $correo = strtolower(str_replace(' ', '', $correo));
                if ($correo !== $usuarioDb->correo) {
                    if ($correo === '' || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                        echo json_encode(['success' => false, 'message' => 'Formato de correo electrónico no válido.']);
                        exit;
                    }
                    if ($this->usuarioModel->emailExistsForOtherUser($correo, $id)) {
                        echo json_encode(['success' => false, 'message' => 'El correo electrónico ya está registrado por otro usuario.']);
                        exit;
                    }
                    $fieldsToUpdate['correo'] = $correo;
                }
            }

            // 4. Telefono
            if (isset($_POST['telefono'])) {
                $telefono = trim($_POST['telefono']);
                if ($telefono !== $usuarioDb->telefono) {
                    if ($telefono === '' || !preg_match('/^[0-9]{10}$/', $telefono)) {
                        echo json_encode(['success' => false, 'message' => 'El teléfono móvil debe tener exactamente 10 dígitos numéricos.']);
                        exit;
                    }
                    $fieldsToUpdate['telefono'] = $telefono;
                }
            }

            // 5. Titulación o Profesión
            if (isset($_POST['titulacion'])) {
                $titulacion = trim($_POST['titulacion']);
                if ($titulacion !== $usuarioDb->titulacion) {
                    if ($titulacion === '' || !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s\.\-]{1,80}$/u', $titulacion)) {
                        echo json_encode(['success' => false, 'message' => 'La titulación es obligatoria (máximo 80 caracteres, solo letras, puntos y guiones).']);
                        exit;
                    }
                    $fieldsToUpdate['titulacion'] = $titulacion;
                }
            }

            if (empty($fieldsToUpdate)) {
                echo json_encode(['success' => true, 'message' => 'No se detectaron cambios para guardar.', 'no_changes' => true]);
                exit;
            }

            try {
                $updated = $this->usuarioModel->updateProfileFields($id, $fieldsToUpdate);
                if (!$updated) {
                    throw new RuntimeException('No fue posible actualizar los datos.');
                }

                if (isset($fieldsToUpdate['nombre']) || isset($fieldsToUpdate['apellido'])) {
                    $newNombre = $fieldsToUpdate['nombre'] ?? $usuarioDb->nombre;
                    $newApellido = $fieldsToUpdate['apellido'] ?? $usuarioDb->apellido;
                    $_SESSION['user_name'] = $newNombre . ' ' . $newApellido;
                }
                if (isset($fieldsToUpdate['titulacion'])) {
                    $_SESSION['user_titulacion'] = $fieldsToUpdate['titulacion'];
                }

                echo json_encode(['success' => true, 'message' => 'Tu perfil fue actualizado correctamente.']);
                exit;
            } catch (Throwable $e) {
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
                exit;
            }
        } else if ($action === 'security') {
            $password = $_POST['contrasena'] ?? '';
            $passwordActual = $_POST['contrasena_actual'] ?? '';
            $passwordConfirm = $_POST['contrasena_confirm'] ?? '';

            if ($password === '') {
                echo json_encode(['success' => false, 'message' => 'La nueva contraseña no puede estar vacía.']);
                exit;
            }

            if ($passwordActual === '') {
                echo json_encode(['success' => false, 'message' => 'Debes ingresar tu contraseña actual para realizar el cambio.']);
                exit;
            }

            $isCurrentValid = ($passwordActual === $usuarioDb->contraseña || password_verify($passwordActual, $usuarioDb->contraseña));
            if (!$isCurrentValid) {
                echo json_encode(['success' => false, 'message' => 'La contraseña actual es incorrecta.']);
                exit;
            }

            if ($password !== $passwordConfirm) {
                echo json_encode(['success' => false, 'message' => 'La nueva contraseña y la confirmación no coinciden.']);
                exit;
            }

            if ($password === $passwordActual) {
                echo json_encode(['success' => false, 'message' => 'La nueva contraseña debe ser diferente de la contraseña actual.']);
                exit;
            }

            if (strlen($password) < 8) {
                echo json_encode(['success' => false, 'message' => 'La nueva contraseña debe tener al menos 8 caracteres.']);
                exit;
            }
            if (!preg_match('/[A-Z]/', $password)) {
                echo json_encode(['success' => false, 'message' => 'La nueva contraseña debe contener al menos una letra mayúscula.']);
                exit;
            }
            if (!preg_match('/[a-z]/', $password)) {
                echo json_encode(['success' => false, 'message' => 'La nueva contraseña debe contener al menos una letra minúscula.']);
                exit;
            }
            if (!preg_match('/[0-9]/', $password)) {
                echo json_encode(['success' => false, 'message' => 'La nueva contraseña debe contener al menos un número.']);
                exit;
            }
            if (!preg_match('/[!@#$%^&*(),.?":{}|<>_\-\[\]]/', $password)) {
                echo json_encode(['success' => false, 'message' => 'La nueva contraseña debe contener al menos un carácter especial.']);
                exit;
            }

            $passwordToUpdate = password_hash($password, PASSWORD_BCRYPT);

            try {
                $updated = $this->usuarioModel->updateProfileFields($id, ['contrasena' => $passwordToUpdate]);
                if (!$updated) {
                    throw new RuntimeException('No fue posible actualizar la contraseña.');
                }
                echo json_encode(['success' => true, 'message' => 'Tu contraseña fue actualizada correctamente.']);
                exit;
            } catch (Throwable $e) {
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
                exit;
            }
        }
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

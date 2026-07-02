<?php
/**
 * Controlador UsuarioController
 * Gestiona el listado de usuarios, registro y asignación de roles.
 */
class UsuarioController extends BaseController {
    private $usuarioModel;
    private $rolModel;
    private $usuarioRolModel;

    public function __construct() {
        $this->usuarioModel = $this->model('Usuario');
        $this->rolModel = $this->model('Rol');
        $this->usuarioRolModel = $this->model('UsuarioRol');
    }

    /**
     * Muestra el catálogo de usuarios y roles
     */
    public function index() {
        $this->requireRol('Coordinador');
        $usuarios = $this->usuarioModel->all();
        $roles = $this->rolModel->all();

        // Extraer roles de cada usuario para mostrarlos de forma elegante en la tabla
        $rolesUsuario = [];
        foreach ($usuarios as $u) {
            $rolesUsuario[$u->id_usuario] = $this->usuarioModel->getRoles($u->id_usuario);
        }

        $this->render('usuarios/index', [
            'titulo' => 'Gestión de Usuarios y Roles',
            'usuarios' => $usuarios,
            'roles' => $roles,
            'rolesUsuario' => $rolesUsuario,
            'current_role' => $_SESSION['current_role'] ?? 'Coordinador'
        ]);
    }

    /**
     * Crear un nuevo usuario y asignarle un rol
     */
    public function create() {
        $this->requireRol('Coordinador');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'] ?? '';
            $apellido = $_POST['apellido'] ?? '';
            $documento = trim($_POST['documento'] ?? '');
            $telefono = $_POST['telefono'] ?? '';
            $correo = $_POST['correo'] ?? '';
            $titulacion = $_POST['titulacion'] ?? '';
            $contrasena = trim($_POST['contrasena'] ?? '');
            $id_rol = $_POST['id_rol'] ?? 0;

            $errores = [];

            if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', $nombre)) $errores[] = "El nombre solo debe contener letras.";
            if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', $apellido)) $errores[] = "El apellido solo debe contener letras.";
            if (!preg_match('/^[0-9]{6,10}$/', $documento)) $errores[] = "El documento debe contener entre 6 y 10 dígitos numéricos.";
            if (!preg_match('/^[0-9]{10}$/', $telefono)) $errores[] = "El teléfono debe contener exactamente 10 números.";
            if (!filter_var($correo, FILTER_VALIDATE_EMAIL) || strpos($correo, '@') === false) $errores[] = "El correo electrónico no es válido.";
            if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', $titulacion)) $errores[] = "La titulación solo debe contener letras.";
            if (!empty($contrasena) && !preg_match('/^[A-Z](?=.*\d)(?=.*[\W_]).{7,29}$/', $contrasena)) {
                $errores[] = "La contraseña debe tener de 8 a 30 caracteres, iniciar con mayúscula, tener un número y un carácter especial.";
            }

            if (!empty($errores)) {
                $_SESSION['flash_error'] = implode("<br>", $errores);
                $this->redirect('usuarios/index');
                return;
            }

            $data = [
                'nombre' => $nombre,
                'apellido' => $apellido,
                'documento' => $documento,
                'telefono' => $telefono,
                'correo' => $correo,
                'titulacion' => $titulacion,
                'usuario' => $documento, // El login es el documento
                'contrasena' => !empty($contrasena) ? password_hash($contrasena, PASSWORD_BCRYPT) : ''
            ];

            if ($this->usuarioModel->create($data)) {
                $db = Database::getInstance();
                $lastId = $db->lastInsertId();
                if ($id_rol > 0 && $lastId > 0) {
                    $this->usuarioRolModel->create($lastId, $id_rol);
                }
                $_SESSION['flash_success'] = 'Usuario registrado y rol asignado correctamente.';
            } else {
                $_SESSION['flash_error'] = 'Error al registrar el usuario.';
            }
        }
        $this->redirect('usuarios/index');
    }

    public function asignarRol() {
        $this->requireRol('Coordinador');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_usuario = $_POST['id_usuario'] ?? 0;
            $id_rol = $_POST['id_rol'] ?? 0;

            // Obtener roles actuales
            $roles_actuales = $this->usuarioModel->getRoles($id_usuario);
            
            // Verificar si ya tiene el rol
            $ya_tiene_rol = false;
            foreach ($roles_actuales as $rol) {
                if ($rol->id_rol == $id_rol) {
                    $ya_tiene_rol = true;
                    break;
                }
            }

            if ($ya_tiene_rol) {
                $_SESSION['flash_error'] = 'El usuario ya posee este rol.';
            } else if (count($roles_actuales) >= 2) {
                $_SESSION['flash_error'] = 'Un usuario no puede tener más de dos roles al mismo tiempo.';
            } else {
                if ($this->usuarioRolModel->create($id_usuario, $id_rol)) {
                    $_SESSION['flash_success'] = 'Rol asignado correctamente al usuario.';
                } else {
                    $_SESSION['flash_error'] = 'Error al asignar el rol.';
                }
            }
        }
        $this->redirect('usuarios/index');
    }

    /**
     * Actualizar un usuario existente
     */
    public function update() {
        $this->requireRol('Coordinador');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_usuario'] ?? 0;
            $nombre = $_POST['nombre'] ?? '';
            $apellido = $_POST['apellido'] ?? '';
            $documento = trim($_POST['documento'] ?? '');
            $telefono = $_POST['telefono'] ?? '';
            $correo = $_POST['correo'] ?? '';
            $titulacion = $_POST['titulacion'] ?? '';
            $contrasena = trim($_POST['contrasena'] ?? '');
            $id_rol = $_POST['id_rol'] ?? 0;

            $errores = [];

            if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', $nombre)) $errores[] = "El nombre solo debe contener letras.";
            if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', $apellido)) $errores[] = "El apellido solo debe contener letras.";
            if (!preg_match('/^[0-9]{6,10}$/', $documento)) $errores[] = "El documento debe contener entre 6 y 10 dígitos numéricos.";
            if (!preg_match('/^[0-9]{10}$/', $telefono)) $errores[] = "El teléfono debe contener exactamente 10 números.";
            if (!filter_var($correo, FILTER_VALIDATE_EMAIL) || strpos($correo, '@') === false) $errores[] = "El correo electrónico no es válido.";
            if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', $titulacion)) $errores[] = "La titulación solo debe contener letras.";
            if (!empty($contrasena) && !preg_match('/^[A-Z](?=.*\d)(?=.*[\W_]).{7,29}$/', $contrasena)) {
                $errores[] = "La contraseña debe tener de 8 a 30 caracteres, iniciar con mayúscula, tener un número y un carácter especial.";
            }

            if (!empty($errores)) {
                $_SESSION['flash_error'] = implode("<br>", $errores);
                $this->redirect('dashboard/index#pills-usuarios');
                return;
            }

            $data = [
                'nombre' => $nombre,
                'apellido' => $apellido,
                'documento' => $documento,
                'telefono' => $telefono,
                'correo' => $correo,
                'titulacion' => $titulacion,
                'usuario' => $documento,
                'contrasena' => !empty($contrasena) ? password_hash($contrasena, PASSWORD_BCRYPT) : ''
            ];

            if ($this->usuarioModel->update($id, $data)) {
                if ($id_rol > 0) {
                    $this->usuarioRolModel->deleteByUsuario($id);
                    $this->usuarioRolModel->create($id, $id_rol);
                }
                $_SESSION['flash_success'] = 'Usuario actualizado correctamente.';
            } else {
                $_SESSION['flash_error'] = 'Error al actualizar el usuario.';
            }
        }
        $this->redirect('dashboard/index#pills-usuarios');
    }

    /**
     * Eliminar un usuario
     */
    public function delete() {
        $this->requireRol('Coordinador');
        $id = $_GET['id'] ?? 0;
        if ($id > 0) {
            // Eliminar roles primero (Cascada manual por si acaso)
            $this->usuarioRolModel->deleteByUsuario($id);
            if ($this->usuarioModel->delete($id)) {
                $_SESSION['flash_success'] = 'Usuario eliminado correctamente.';
            } else {
                $_SESSION['flash_error'] = 'Error al eliminar el usuario.';
            }
        }
        $this->redirect('dashboard/index#pills-usuarios');
    }
}

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
            $data = [
                'nombre' => $_POST['nombre'] ?? '',
                'apellido' => $_POST['apellido'] ?? '',
                'documento' => trim($_POST['documento'] ?? ''),
                'telefono' => $_POST['telefono'] ?? '',
                'correo' => $_POST['correo'] ?? '',
                'titulacion' => $_POST['titulacion'] ?? '',
                'usuario' => trim($_POST['documento'] ?? ''), // El login es el documento
                'contrasena' => !empty($_POST['contrasena']) ? password_hash(trim($_POST['contrasena']), PASSWORD_BCRYPT) : ''
            ];

            $id_rol = $_POST['id_rol'] ?? 0;

            if ($this->usuarioModel->create($data)) {
                // Obtener el ID insertado
                $db = Database::getInstance();
                $lastId = $db->lastInsertId();

                // Asignar el rol
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

    /**
     * Asignar un rol adicional a un usuario existente
     */
    public function asignarRol() {
        $this->requireRol('Coordinador');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_usuario = $_POST['id_usuario'] ?? 0;
            $id_rol = $_POST['id_rol'] ?? 0;

            if ($this->usuarioRolModel->create($id_usuario, $id_rol)) {
                $_SESSION['flash_success'] = 'Rol asignado correctamente al usuario.';
            } else {
                $_SESSION['flash_error'] = 'El usuario ya posee este rol.';
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
            $data = [
                'nombre' => $_POST['nombre'] ?? '',
                'apellido' => $_POST['apellido'] ?? '',
                'documento' => trim($_POST['documento'] ?? ''),
                'telefono' => $_POST['telefono'] ?? '',
                'correo' => $_POST['correo'] ?? '',
                'titulacion' => $_POST['titulacion'] ?? '',
                'usuario' => trim($_POST['documento'] ?? ''),
                'contrasena' => !empty($_POST['contrasena']) ? password_hash(trim($_POST['contrasena']), PASSWORD_BCRYPT) : ''
            ];

            if ($this->usuarioModel->update($id, $data)) {
                // Actualizar rol principal si se envía
                $id_rol = $_POST['id_rol'] ?? 0;
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

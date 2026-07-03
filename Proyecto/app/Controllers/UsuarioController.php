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

    /**
     * Generar y descargar reporte de usuarios en PDF
     */
    public function exportarPDF() {
        $this->requireRol('Coordinador');
        
        // Importación de la librería FPDF (se verificó que fpdf.php está directamente en Libraries)
        require_once dirname(__DIR__) . '/Libraries/fpdf.php';

        $db = Database::getInstance();
        $db->query("SELECT u.documento, 
                           CONCAT(u.nombre, ' ', u.apellido) AS nombre_completo, 
                           u.correo, 
                           u.titulacion, 
                           COALESCE(GROUP_CONCAT(r.nombre_rol SEPARATOR ', '), 'Sin Rol') AS roles
                    FROM usuarios u
                    LEFT JOIN usuario_rol ur ON u.id_usuario = ur.id_usuario
                    LEFT JOIN rol r ON ur.id_rol = r.id_rol
                    GROUP BY u.id_usuario
                    ORDER BY u.nombre ASC");
        $usuarios = $db->resultSet();

        $pdf = new FPDF('L', 'mm', 'A4');
        $pdf->AddPage();
        
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 15, utf8_decode('Reporte de Usuarios Registrados'), 0, 1, 'C');
        $pdf->Ln(2);

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->SetFillColor(220, 220, 220); 
        $pdf->SetTextColor(0, 0, 0); 
        
        $w_doc = 35;
        $w_nom = 65;
        $w_cor = 75;
        $w_tit = 55;
        $w_rol = 47;

        $pdf->Cell($w_doc, 10, 'Documento', 1, 0, 'C', true);
        $pdf->Cell($w_nom, 10, 'Nombre', 1, 0, 'C', true);
        $pdf->Cell($w_cor, 10, 'Correo', 1, 0, 'C', true);
        $pdf->Cell($w_tit, 10, utf8_decode('Titulación'), 1, 0, 'C', true);
        $pdf->Cell($w_rol, 10, 'Rol', 1, 1, 'C', true); 

        $pdf->SetFont('Arial', '', 10);
        $pdf->SetFillColor(255, 255, 255);

        foreach ($usuarios as $u) {
            $pdf->Cell($w_doc, 8, utf8_decode($u->documento), 1, 0, 'C');
            $pdf->Cell($w_nom, 8, utf8_decode($u->nombre_completo), 1, 0, 'L');
            $pdf->Cell($w_cor, 8, utf8_decode($u->correo), 1, 0, 'L');
            $pdf->Cell($w_tit, 8, utf8_decode($u->titulacion), 1, 0, 'C');
            $pdf->Cell($w_rol, 8, utf8_decode($u->roles), 1, 1, 'C');
        }

        $pdf->Output('D', 'Reporte_Usuarios_SIGPA.pdf');
        exit;
    }

    /**
     * Forzar descarga de la plantilla CSV para creación masiva de usuarios
     */
    public function descargarPlantilla() {
        $this->requireRol('Coordinador');
        
        $filename = "plantilla_usuarios.csv";
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        
        // Escribir BOM para correcta lectura de UTF-8 en Excel
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
        
        // Fila de cabeceras requeridas
        fputcsv($output, ['documento', 'nombre', 'apellido', 'telefono', 'correo', 'titulacion', 'usuario', 'contraseña', 'id_rol']);
        
        fclose($output);
        exit;
    }

    /**
     * Procesar la carga masiva de usuarios vía CSV (Estrictamente JSON y Transaccional)
     */
    public function importarMasivoCSV() {
        $this->requireRol('Coordinador');
        header('Content-Type: application/json');
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_FILES['archivo_csv'])) {
            echo json_encode(['status' => 'error', 'message' => 'Petición inválida o no se adjuntó archivo.']);
            exit;
        }

        $file = $_FILES['archivo_csv']['tmp_name'];
        if (!$file) {
            echo json_encode(['status' => 'error', 'message' => 'Error al subir el archivo CSV al servidor.']);
            exit;
        }

        $handle = fopen($file, 'r');
        if ($handle === false) {
            echo json_encode(['status' => 'error', 'message' => 'No se pudo leer el archivo CSV.']);
            exit;
        }

        $db = Database::getInstance();
        $db->beginTransaction();

        $usuarios_insertados = [];
        $fila = 1;
        
        try {
            // Leer y descartar la primera fila (cabeceras)
            fgetcsv($handle, 1000, ",");

            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $fila++;
                
                // Ignorar filas totalmente vacías
                if (empty(array_filter($data))) continue;

                if (count($data) < 9) {
                    throw new Exception("Faltan columnas en la fila $fila. Asegúrese de usar la plantilla descargada.");
                }

                $documento  = trim($data[0]);
                $nombre     = trim($data[1]);
                $apellido   = trim($data[2]);
                $telefono   = trim($data[3]);
                $correo     = trim($data[4]);
                $titulacion = trim($data[5]);
                $usuario    = trim($data[6]);
                $contrasena = trim($data[7]);
                $id_rol     = (int) trim($data[8]);

                if (empty($documento) || empty($nombre) || empty($usuario)) {
                    throw new Exception("El documento, nombre y usuario son obligatorios (Fila $fila).");
                }

                $hash = !empty($contrasena) ? password_hash($contrasena, PASSWORD_BCRYPT) : '';

                // Inserción en tabla usuarios
                $db->query("INSERT INTO usuarios (documento, nombre, apellido, telefono, correo, titulacion, usuario, contrasena) 
                            VALUES (:documento, :nombre, :apellido, :telefono, :correo, :titulacion, :usuario, :contrasena)");
                $db->bind(':documento', $documento);
                $db->bind(':nombre', $nombre);
                $db->bind(':apellido', $apellido);
                $db->bind(':telefono', $telefono);
                $db->bind(':correo', $correo);
                $db->bind(':titulacion', $titulacion);
                $db->bind(':usuario', $usuario);
                $db->bind(':contrasena', $hash);
                
                if (!$db->execute()) {
                    throw new Exception("Error insertando el documento $documento. ¿Es posible que ya exista?");
                }

                $id_usuario = $db->lastInsertId();

                // Inserción en tabla usuario_rol
                if ($id_rol > 0) {
                    $db->query("INSERT INTO usuario_rol (id_usuario, id_rol) VALUES (:id_usuario, :id_rol)");
                    $db->bind(':id_usuario', $id_usuario);
                    $db->bind(':id_rol', $id_rol);
                    if (!$db->execute()) {
                        throw new Exception("No se pudo asignar el rol al usuario $documento.");
                    }
                }
                
                // Interpretar el nombre del rol para el JSON de respuesta
                $nombre_rol = 'Sin Rol';
                if ($id_rol === 1) $nombre_rol = 'Coordinador';
                if ($id_rol === 2) $nombre_rol = 'Instructor';
                if ($id_rol === 3) $nombre_rol = 'Aprendiz';

                $usuarios_insertados[] = [
                    'id_usuario' => $id_usuario,
                    'documento'  => $documento,
                    'nombre'     => $nombre,
                    'apellido'   => $apellido,
                    'correo'     => $correo,
                    'telefono'   => $telefono,
                    'titulacion' => $titulacion,
                    'usuario'    => $usuario,
                    'nombre_rol' => $nombre_rol
                ];
            }
            
            fclose($handle);
            $db->commit();
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Carga masiva completada exitosamente.',
                'data' => $usuarios_insertados
            ]);
            
        } catch (Exception $e) {
            $db->rollBack();
            if ($handle) fclose($handle);
            echo json_encode([
                'status' => 'error',
                'message' => 'Se canceló toda la carga. Razón: ' . $e->getMessage()
            ]);
        }
        exit;
    }
}

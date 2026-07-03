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

        // Intentar descargar el logo del SENA si no existe localmente
        $logoPath = dirname(__DIR__, 2) . '/public/logo-sena.png';
        if (!file_exists($logoPath)) {
            $logoUrl = 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/83/Sena_Colombia_logo.svg/500px-Sena_Colombia_logo.svg.png';
            $context = stream_context_create([
                'http' => [
                    'header' => "User-Agent: SIGPA-App/1.0 (https://github.com/sebas332/SIGPA)\r\n",
                    'timeout' => 5
                ]
            ]);
            $logoData = @file_get_contents($logoUrl, false, $context);
            if ($logoData) {
                @file_put_contents($logoPath, $logoData);
            }
        }

        $db = Database::getInstance();
        $db->query("SELECT u.documento, 
                           CONCAT(u.nombre, ' ', u.apellido) AS nombre_completo, 
                           u.correo, 
                           u.telefono,
                           u.titulacion, 
                           COALESCE(GROUP_CONCAT(r.nombre_rol SEPARATOR ', '), 'Sin Rol') AS roles
                    FROM usuarios u
                    LEFT JOIN usuario_rol ur ON u.id_usuario = ur.id_usuario
                    LEFT JOIN rol r ON ur.id_rol = r.id_rol
                    GROUP BY u.id_usuario
                    ORDER BY u.nombre, u.apellido");
        $usuarios = $db->resultSet();

        // Instanciar FPDF usando una clase anónima para evitar problemas de anidamiento de clases
        $pdf = new class('L', 'mm', 'A4') extends FPDF {
            public $logoFile;

            function Header() {
                // Logo del SENA
                $logoDrawn = false;
                if (!empty($this->logoFile) && file_exists($this->logoFile)) {
                    try {
                        $this->Image($this->logoFile, 15, 10, 18);
                        $logoDrawn = true;
                    } catch (Exception $e) {
                        // Fallback si la imagen está corrupta o falla el cargado
                    }
                }

                if (!$logoDrawn) {
                    // Rectángulo verde alternativo
                    $this->SetFillColor(57, 169, 0);
                    $this->Rect(15, 10, 18, 18, 'F');
                    $this->SetTextColor(255, 255, 255);
                    $this->SetFont('Arial', 'B', 8);
                    $this->SetXY(15, 17);
                    $this->Cell(18, 4, 'SENA', 0, 0, 'C');
                }

                // Títulos del encabezado
                $this->SetTextColor(80, 80, 80);
                $this->SetFont('Arial', 'B', 10);
                $this->SetXY(38, 10);
                $this->Cell(0, 5, utf8_decode('SISTEMA DE GESTIÓN ACADÉMICA (SIGPA)'), 0, 1, 'L');

                $this->SetTextColor(57, 169, 0); // Verde SENA
                $this->SetFont('Arial', 'B', 16);
                $this->SetX(38);
                $this->Cell(0, 8, utf8_decode('Reporte General de Usuarios Registrados'), 0, 1, 'L');

                $this->SetTextColor(120, 120, 120);
                $this->SetFont('Arial', 'I', 9);
                $this->SetX(38);
                $fecha = date('d/m/Y h:i A');
                $this->Cell(0, 5, utf8_decode('Fecha de generación: ' . $fecha), 0, 1, 'L');

                // Línea decorativa verde
                $this->SetDrawColor(57, 169, 0);
                $this->SetLineWidth(0.8);
                $this->Line(15, 32, 282, 32);

                // Espacio después del encabezado
                $this->Ln(10);
            }

            function Footer() {
                $this->SetY(-15);
                $this->SetFont('Arial', 'I', 8);
                $this->SetTextColor(128, 128, 128);

                // Línea de separación gris
                $this->SetDrawColor(220, 220, 220);
                $this->SetLineWidth(0.3);
                $this->Line(15, $this->GetY(), 282, $this->GetY());

                // Número de página y texto legal
                $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . ' de {nb}', 0, 0, 'R');
                $this->SetX(15);
                $this->Cell(0, 10, utf8_decode('SIGPA - Reporte de Usuarios Institucional'), 0, 0, 'L');
            }
        };

        $pdf->logoFile = $logoPath;
        $pdf->AliasNbPages();
        $pdf->SetMargins(15, 35, 15);
        $pdf->AddPage();

        // Estilos de la cabecera de la tabla
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(57, 169, 0); // Verde SENA
        $pdf->SetTextColor(255, 255, 255); // Blanco
        $pdf->SetDrawColor(40, 120, 0); // Borde verde oscuro
        $pdf->SetLineWidth(0.3);

        $w_doc = 30;
        $w_nom = 60;
        $w_cor = 65;
        $w_tel = 30;
        $w_tit = 50;
        $w_rol = 32;

        $pdf->Cell($w_doc, 10, 'Documento', 1, 0, 'C', true);
        $pdf->Cell($w_nom, 10, 'Nombre Completo', 1, 0, 'C', true);
        $pdf->Cell($w_cor, 10, 'Correo', 1, 0, 'C', true);
        $pdf->Cell($w_tel, 10, utf8_decode('Contacto'), 1, 0, 'C', true);
        $pdf->Cell($w_tit, 10, utf8_decode('Titulación'), 1, 0, 'C', true);
        $pdf->Cell($w_rol, 10, 'Rol', 1, 1, 'C', true);

        // Estilos del cuerpo de la tabla
        $pdf->SetFont('Arial', '', 9);
        $pdf->SetTextColor(50, 50, 50); // Gris oscuro para mejor lectura
        $pdf->SetDrawColor(220, 220, 220); // Gris claro para bordes

        $fill = false;
        foreach ($usuarios as $u) {
            if ($fill) {
                $pdf->SetFillColor(245, 250, 245); // Fila alternada verde muy suave
            } else {
                $pdf->SetFillColor(255, 255, 255); // Fila blanca
            }

            $pdf->Cell($w_doc, 8, utf8_decode($u->documento), 1, 0, 'C', true);
            $pdf->Cell($w_nom, 8, utf8_decode($u->nombre_completo), 1, 0, 'L', true);
            $pdf->Cell($w_cor, 8, utf8_decode($u->correo), 1, 0, 'L', true);
            $pdf->Cell($w_tel, 8, utf8_decode($u->telefono), 1, 0, 'C', true);
            $pdf->Cell($w_tit, 8, utf8_decode($u->titulacion), 1, 0, 'L', true);
            $pdf->Cell($w_rol, 8, utf8_decode($u->roles), 1, 1, 'C', true);

            $fill = !$fill;
        }

        $pdf->Output('D', 'Reporte_Usuarios_SIGPA.pdf');
        exit;
    }

    /**
     * Generar y descargar reporte de usuarios en Excel (CSV)
     */
    public function exportarExcel() {
        $this->requireRol('Coordinador');

        $db = Database::getInstance();
        $db->query("SELECT u.documento, 
                           CONCAT(u.nombre, ' ', u.apellido) AS nombre_completo, 
                           u.correo, 
                           u.telefono, 
                           u.titulacion, 
                           COALESCE(GROUP_CONCAT(r.nombre_rol SEPARATOR ', '), 'Sin Rol') AS roles
                    FROM usuarios u
                    LEFT JOIN usuario_rol ur ON u.id_usuario = ur.id_usuario
                    LEFT JOIN rol r ON ur.id_rol = r.id_rol
                    GROUP BY u.id_usuario
                    ORDER BY u.nombre, u.apellido");
        $usuarios = $db->resultSet();

        $filename = "plantilla_usuarios.xls";
        header('Content-Type: application/vnd.ms-excel; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        // Escribir el documento HTML que Excel interpretará con estilos
        echo '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">';
        echo '<head>';
        echo '<meta http-equiv="Content-type" content="text/html;charset=utf-8" />';
        echo '<style>';
        echo '  .title { font-family: Arial, sans-serif; font-size: 14pt; font-weight: bold; color: #39A900; }';
        echo '  .subtitle { font-family: Arial, sans-serif; font-size: 10pt; color: #555555; }';
        echo '  .table-data { font-family: Arial, sans-serif; border-collapse: collapse; margin-top: 15px; }';
        echo '  .table-data th { background-color: #39A900; color: #FFFFFF; font-weight: bold; border: 1px solid #287800; text-align: center; font-size: 11pt; padding: 6px; }';
        echo '  .table-data td { border: 1px solid #DDDDDD; font-size: 10pt; padding: 5px; }';
        echo '  .zebra { background-color: #F5FAF5; }';
        echo '  .logo-box { background-color: #39A900; color: #FFFFFF; font-family: Arial, sans-serif; font-weight: bold; font-size: 12pt; text-align: center; vertical-align: middle; }';
        echo '</style>';
        echo '</head>';
        echo '<body>';
        
        // Tabla de Encabezado/Logo
        echo '<table border="0" style="border-collapse: collapse;">';
        echo '  <tr>';
        echo '    <td class="logo-box" rowspan="3" colspan="2" style="width: 120px; border: 1px solid #287800;">SENA</td>';
        echo '    <td colspan="4" class="title" style="padding-left: 10px;">SISTEMA DE GESTIÓN ACADÉMICA (SIGPA)</td>';
        echo '  </tr>';
        echo '  <tr>';
        echo '    <td colspan="4" style="font-family: Arial, sans-serif; font-weight: bold; font-size: 11pt; padding-left: 10px; color: #333333;">Reporte General de Usuarios Registrados</td>';
        echo '  </tr>';
        echo '  <tr>';
        echo '    <td colspan="4" class="subtitle" style="padding-left: 10px; font-style: italic;">Generado el: ' . date('d/m/Y h:i A') . '</td>';
        echo '  </tr>';
        echo '</table>';
        echo '<br />';
        
        // Tabla de Datos
        echo '<table class="table-data" border="1">';
        echo '  <thead>';
        echo '    <tr>';
        echo '      <th style="width: 100px;">Documento</th>';
        echo '      <th style="width: 180px;">Nombre Completo</th>';
        echo '      <th style="width: 220px;">Correo</th>';
        echo '      <th style="width: 110px;">Contacto</th>';
        echo '      <th style="width: 200px;">Titulación</th>';
        echo '      <th style="width: 120px;">Rol</th>';
        echo '    </tr>';
        echo '  </thead>';
        echo '  <tbody>';
        
        $fill = false;
        foreach ($usuarios as $u) {
            $class = $fill ? ' class="zebra"' : '';
            echo '    <tr' . $class . '>';
            // Forzar formato de texto para documento y teléfono para que Excel no trunque los ceros iniciales
            echo '      <td style="text-align: center; mso-number-format:\'\@\';">' . htmlspecialchars($u->documento, ENT_QUOTES, 'UTF-8') . '</td>';
            echo '      <td style="text-align: left;">' . htmlspecialchars($u->nombre_completo, ENT_QUOTES, 'UTF-8') . '</td>';
            echo '      <td style="text-align: left;">' . htmlspecialchars($u->correo, ENT_QUOTES, 'UTF-8') . '</td>';
            echo '      <td style="text-align: center; mso-number-format:\'\@\';">' . htmlspecialchars($u->telefono, ENT_QUOTES, 'UTF-8') . '</td>';
            echo '      <td style="text-align: left;">' . htmlspecialchars($u->titulacion, ENT_QUOTES, 'UTF-8') . '</td>';
            echo '      <td style="text-align: center;">' . htmlspecialchars($u->roles, ENT_QUOTES, 'UTF-8') . '</td>';
            echo '    </tr>';
            $fill = !$fill;
        }
        
        echo '  </tbody>';
        echo '</table>';
        echo '</body>';
        echo '</html>';
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

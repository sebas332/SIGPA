<?php
/**
 * Controlador ReporteController
 * Gestiona la consulta de reportes con buscador en tiempo real, exportación a PDF/Excel e Impresión.
 */
class ReporteController extends BaseController {

    public function __construct() {
        $this->requireLogin();
    }

    /**
     * Vista principal del panel de reportes con buscador y resultados
     */
    public function index() {
        $this->requireRol('Coordinador');

        $tipo_reporte = $_GET['tipo_reporte'] ?? 'programacion';
        $search = $_GET['search'] ?? '';

        $resultados = [];
        $error_mensaje = '';
        try {
            $resultados = $this->obtenerDatosReporte($tipo_reporte);
        } catch (Exception $e) {
            $error_mensaje = 'Error al ejecutar la consulta: ' . $e->getMessage();
        }

        $titulos_reporte = [
            'programacion' => 'Reporte de Programación Académica',
            'instructores' => 'Reporte de Instructores',
            'ambientes'    => 'Reporte de Ambientes Físicos',
            'fichas'       => 'Reporte de Fichas Académicas',
            'programas'    => 'Reporte de Programas Formativos',
            'competencias' => 'Reporte de Competencias',
            'resultados'   => 'Reporte de Resultados de Aprendizaje',
            'asistencias'  => 'Reporte de Control de Asistencias',
            'novedades'    => 'Reporte de Novedades de Ambientes',
        ];

        $this->render('reportes/index', [
            'titulo'       => 'Reportes del Sistema',
            'tipo_reporte' => $tipo_reporte,
            'search'       => $search,
            'resultados'   => $resultados,
            'error_mensaje'=> $error_mensaje,
            'report_title' => $titulos_reporte[$tipo_reporte] ?? 'Reporte',
            'current_role' => $_SESSION['current_role'] ?? 'Coordinador'
        ]);
    }

    /**
     * Generar reporte en PDF
     */
    public function exportarPDF() {
        $this->requireRol('Coordinador');

        $tipo_reporte = $_GET['tipo_reporte'] ?? 'programacion';
        $search = trim($_GET['search'] ?? '');

        try {
            $resultados = $this->obtenerDatosReporte($tipo_reporte);
            $resultados = $this->filtrarResultadosPHP($resultados, $tipo_reporte, $search);
        } catch (Exception $e) {
            $_SESSION['flash_error'] = 'Error de base de datos: ' . $e->getMessage();
            $this->redirect('reportes/index?tipo_reporte=' . $tipo_reporte);
        }

        if (empty($resultados)) {
            $_SESSION['flash_error'] = 'No existen registros para exportar con la búsqueda realizada.';
            $this->redirect('reportes/index?tipo_reporte=' . $tipo_reporte);
        }

        // Cargar FPDF
        require_once APPROOT . '/Libraries/fpdf.php';

        $logoPath = APPROOT . '/../public/logo-sena.png';
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

        $config = $this->obtenerConfiguracionColumnas($tipo_reporte);
        $titulos_reporte = [
            'programacion' => 'Programacion Academica',
            'instructores' => 'Instructores del Sistema',
            'ambientes'    => 'Ambientes Fisicos',
            'fichas'       => 'Fichas Academicas',
            'programas'    => 'Programas Formativos',
            'competencias' => 'Competencias de Formacion',
            'resultados'   => 'Resultados de Aprendizaje',
            'asistencias'  => 'Control de Asistencias',
            'novedades'    => 'Novedades y Averias de Ambiente',
        ];
        $titulo_amigable = $titulos_reporte[$tipo_reporte] ?? 'Reporte';

        // Instanciar FPDF
        $pdf = new class('L', 'mm', 'A4') extends FPDF {
            public $logoFile;
            public $reportTitle;

            function Header() {
                $logoDrawn = false;
                if (!empty($this->logoFile) && file_exists($this->logoFile)) {
                    try {
                        $this->Image($this->logoFile, 15, 10, 18);
                        $logoDrawn = true;
                    } catch (Exception $e) {}
                }

                if (!$logoDrawn) {
                    $this->SetFillColor(57, 169, 0);
                    $this->Rect(15, 10, 18, 18, 'F');
                    $this->SetTextColor(255, 255, 255);
                    $this->SetFont('Arial', 'B', 8);
                    $this->SetXY(15, 17);
                    $this->Cell(18, 4, 'SENA', 0, 0, 'C');
                }

                $this->SetTextColor(80, 80, 80);
                $this->SetFont('Arial', 'B', 10);
                $this->SetXY(38, 10);
                $this->Cell(0, 5, utf8_decode('SISTEMA DE GESTIÓN ACADÉMICA (SIGPA)'), 0, 1, 'L');

                $this->SetTextColor(57, 169, 0);
                $this->SetFont('Arial', 'B', 15);
                $this->SetX(38);
                $this->Cell(0, 8, utf8_decode('Reporte: ' . $this->reportTitle), 0, 1, 'L');

                $this->SetTextColor(120, 120, 120);
                $this->SetFont('Arial', 'I', 9);
                $this->SetX(38);
                $fecha = date('d/m/Y h:i A');
                $this->Cell(0, 5, utf8_decode('Fecha de generación: ' . $fecha), 0, 1, 'L');

                $this->SetDrawColor(57, 169, 0);
                $this->SetLineWidth(0.8);
                $this->Line(15, 32, 282, 32);

                $this->Ln(10);
            }

            function Footer() {
                $this->SetY(-15);
                $this->SetFont('Arial', 'I', 8);
                $this->SetTextColor(128, 128, 128);

                $this->SetDrawColor(220, 220, 220);
                $this->SetLineWidth(0.3);
                $this->Line(15, $this->GetY(), 282, $this->GetY());

                $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . ' de {nb}', 0, 0, 'R');
                $this->SetX(15);
                $this->Cell(0, 10, utf8_decode('SIGPA - Reportes Oficiales Institucionales'), 0, 0, 'L');
            }
        };

        $pdf->logoFile = $logoPath;
        $pdf->reportTitle = $titulo_amigable;
        $pdf->AliasNbPages();
        $pdf->SetMargins(15, 35, 15);
        $pdf->AddPage();

        // Cabeceras
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetFillColor(57, 169, 0);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetDrawColor(40, 120, 0);
        $pdf->SetLineWidth(0.3);

        foreach ($config['columns'] as $col) {
            $pdf->Cell($col['width'], 9, utf8_decode($col['title']), 1, 0, 'C', true);
        }
        $pdf->Ln();

        // Cuerpo
        $pdf->SetFont('Arial', '', 8.5);
        $pdf->SetTextColor(50, 50, 50);
        $pdf->SetDrawColor(220, 220, 220);

        $fill = false;
        foreach ($resultados as $row) {
            if ($fill) {
                $pdf->SetFillColor(245, 250, 245);
            } else {
                $pdf->SetFillColor(255, 255, 255);
            }

            foreach ($config['columns'] as $col) {
                $valor = $this->obtenerValorCampoPDF($tipo_reporte, $row, $col['field']);
                $pdf->Cell($col['width'], 8, utf8_decode($valor), 1, 0, $col['align'], true);
            }
            $pdf->Ln();
            $fill = !$fill;
        }

        $pdf->Output('D', 'Reporte_' . ucfirst($tipo_reporte) . '_' . date('Ymd_His') . '.pdf');
        exit;
    }

    /**
     * Generar reporte en Excel
     */
    public function exportarExcel() {
        $this->requireRol('Coordinador');

        $tipo_reporte = $_GET['tipo_reporte'] ?? 'programacion';
        $search = trim($_GET['search'] ?? '');

        try {
            $resultados = $this->obtenerDatosReporte($tipo_reporte);
            $resultados = $this->filtrarResultadosPHP($resultados, $tipo_reporte, $search);
        } catch (Exception $e) {
            $_SESSION['flash_error'] = 'Error de base de datos: ' . $e->getMessage();
            $this->redirect('reportes/index?tipo_reporte=' . $tipo_reporte);
        }

        if (empty($resultados)) {
            $_SESSION['flash_error'] = 'No existen registros para exportar con la búsqueda realizada.';
            $this->redirect('reportes/index?tipo_reporte=' . $tipo_reporte);
        }

        $filename = "Reporte_" . ucfirst($tipo_reporte) . "_" . date('Ymd_His') . ".xls";
        header('Content-Type: application/vnd.ms-excel; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        echo '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">';
        echo '<head>';
        echo '<meta http-equiv="Content-type" content="text/html;charset=utf-8" />';
        echo '<style>';
        echo '  .title { font-family: Arial, sans-serif; font-size: 14pt; font-weight: bold; color: #39A900; }';
        echo '  .subtitle { font-family: Arial, sans-serif; font-size: 10pt; color: #555555; }';
        echo '  .table-data { font-family: Arial, sans-serif; border-collapse: collapse; margin-top: 15px; }';
        echo '  .table-data th { background-color: #39A900; color: #FFFFFF; font-weight: bold; border: 1px solid #287800; text-align: center; font-size: 11pt; padding: 8px; }';
        echo '  .table-data td { border: 1px solid #DDDDDD; font-size: 10pt; padding: 6px; }';
        echo '  .zebra { background-color: #F5FAF5; }';
        echo '  .logo-box { background-color: #39A900; color: #FFFFFF; font-family: Arial, sans-serif; font-weight: bold; font-size: 14pt; text-align: center; vertical-align: middle; }';
        echo '</style>';
        echo '</head>';
        echo '<body>';

        $titulos_reporte = [
            'programacion' => 'Reporte General de Programación Académica',
            'instructores' => 'Reporte General de Instructores',
            'ambientes'    => 'Reporte General de Ambientes Físicos',
            'fichas'       => 'Reporte General de Fichas Académicas',
            'programas'    => 'Reporte General de Programas Formativos',
            'competencias' => 'Reporte General de Competencias',
            'resultados'   => 'Reporte General de Resultados de Aprendizaje',
            'asistencias'  => 'Reporte General de Asistencias',
            'novedades'    => 'Reporte General de Novedades de Ambientes',
        ];
        $titulo_excel = $titulos_reporte[$tipo_reporte] ?? 'Reporte del Sistema';

        $config = $this->obtenerConfiguracionColumnas($tipo_reporte);
        $total_columnas = count($config['columns']);

        echo '<table border="0" style="border-collapse: collapse;">';
        echo '  <tr>';
        echo '    <td class="logo-box" rowspan="3" colspan="2" style="width: 100px; border: 1px solid #287800;">SENA</td>';
        echo '    <td colspan="' . ($total_columnas - 2) . '" class="title" style="padding-left: 10px;">SISTEMA DE GESTIÓN ACADÉMICA (SIGPA)</td>';
        echo '  </tr>';
        echo '  <tr>';
        echo '    <td colspan="' . ($total_columnas - 2) . '" style="font-family: Arial, sans-serif; font-weight: bold; font-size: 11pt; padding-left: 10px; color: #333333;">' . $titulo_excel . '</td>';
        echo '  </tr>';
        echo '  <tr>';
        echo '    <td colspan="' . ($total_columnas - 2) . '" class="subtitle" style="padding-left: 10px; font-style: italic;">Generado el: ' . date('d/m/Y h:i A') . '</td>';
        echo '  </tr>';
        echo '</table>';
        echo '<br />';

        echo '<table class="table-data" border="1">';
        echo '  <thead>';
        echo '    <tr>';
        foreach ($config['columns'] as $col) {
            echo '      <th>' . htmlspecialchars($col['title']) . '</th>';
        }
        echo '    </tr>';
        echo '  </thead>';
        echo '  <tbody>';

        $fill = false;
        foreach ($resultados as $row) {
            $class = $fill ? ' class="zebra"' : '';
            echo '    <tr' . $class . '>';
            foreach ($config['columns'] as $col) {
                $valor = $this->obtenerValorCampoPDF($tipo_reporte, $row, $col['field']);
                echo '      <td style="text-align: ' . ($col['align'] === 'L' ? 'left' : ($col['align'] === 'R' ? 'right' : 'center')) . ';">' . htmlspecialchars($valor) . '</td>';
            }
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
     * Filtra los resultados del reporte en PHP por el término de búsqueda
     */
    private function filtrarResultadosPHP($resultados, $tipo_reporte, $search) {
        if ($search === '') {
            return $resultados;
        }
        $searchLower = mb_strtolower($search, 'UTF-8');
        return array_filter($resultados, function($row) use ($searchLower, $tipo_reporte) {
            $rowText = '';
            foreach (get_object_vars($row) as $key => $val) {
                if ($val !== null) {
                    $rowText .= ' ' . mb_strtolower((string)$val, 'UTF-8');
                }
            }
            // Agregar campos formateados
            if ($tipo_reporte === 'programacion') {
                $rowText .= ' ' . mb_strtolower(substr($row->hora_inicio, 0, 5) . ' - ' . substr($row->hora_fin, 0, 5), 'UTF-8');
                $rowText .= ' ' . $row->sesiones_realizadas . ' / ' . $row->total_sesiones;
            } elseif ($tipo_reporte === 'ambientes') {
                $rowText .= ' ' . ($row->disponibilidad ? 'disponible' : 'no disp.');
            } elseif ($tipo_reporte === 'asistencias') {
                $rowText .= ' ' . ($row->asistio ? 'asistio' : 'falto');
            }
            return strpos($rowText, $searchLower) !== false;
        });
    }

    /**
     * Ejecuta la consulta SQL base para cada tipo de reporte
     */
    private function obtenerDatosReporte($tipo) {
        $db = Database::getInstance();
        switch ($tipo) {
            case 'programacion':
                $sql = "SELECT pa.*, f.numero_ficha, pr.nombre as programa_nombre, pr.id_programa,
                               CONCAT(u.nombre, ' ', u.apellido) as instructor_nombre, u.id_usuario as id_instructor,
                               a.nombre as ambiente_nombre, a.id_numero_ambiente, d.nombre_dia, pa.id_dias, ra.codigo as ra_codigo, 
                               ra.descripcion as ra_descripcion, c.nombre as competencia_nombre, ra.id_competencia,
                               j.nombre as jornada_nombre, f.id_jornada
                        FROM programacion_academica pa
                        INNER JOIN fichas f ON pa.numero_ficha = f.numero_ficha
                        INNER JOIN usuarios u ON pa.id_usuario = u.id_usuario
                        INNER JOIN ambientes a ON pa.id_numero_ambiente = a.id_numero_ambiente
                        INNER JOIN dias d ON pa.id_dias = d.id_dias
                        INNER JOIN resultado_aprendizaje ra ON pa.id_resultado_aprendizaje = ra.id_resultado
                        INNER JOIN competencias c ON ra.id_competencia = c.id_competencia
                        INNER JOIN programa pr ON f.id_programa = pr.id_programa
                        INNER JOIN jornada j ON f.id_jornada = j.id_jornada
                        ORDER BY pa.fecha_inicio DESC, pa.hora_inicio ASC";
                break;

            case 'instructores':
                $sql = "SELECT u.*,
                               (SELECT COUNT(*) FROM programacion_academica pa WHERE pa.id_usuario = u.id_usuario) AS total_programaciones,
                               (SELECT COUNT(DISTINCT pa.numero_ficha) FROM programacion_academica pa WHERE pa.id_usuario = u.id_usuario) AS total_fichas
                        FROM usuarios u
                        INNER JOIN usuario_rol ur ON u.id_usuario = ur.id_usuario
                        WHERE ur.id_rol = 2
                        ORDER BY u.nombre, u.apellido";
                break;

            case 'ambientes':
                $sql = "SELECT a.*,
                               (SELECT COUNT(*) FROM programacion_academica pa WHERE pa.id_numero_ambiente = a.id_numero_ambiente) AS total_programaciones
                        FROM ambientes a
                        ORDER BY a.nombre";
                break;

            case 'fichas':
                $sql = "SELECT f.*, 
                               CONCAT(u.nombre, ' ', u.apellido) AS instructor_lider_nombre, f.id_usuario_instructor_lider,
                               p.nombre AS programa_nombre, f.id_programa,
                               j.nombre AS jornada_nombre, f.id_jornada,
                               (SELECT COUNT(*) FROM ficha_aprendiz fa WHERE fa.numero_ficha = f.numero_ficha) AS total_aprendices
                        FROM fichas f
                        INNER JOIN usuarios u ON f.id_usuario_instructor_lider = u.id_usuario
                        INNER JOIN programa p ON f.id_programa = p.id_programa
                        INNER JOIN jornada j ON f.id_jornada = j.id_jornada
                        ORDER BY f.numero_ficha";
                break;

            case 'programas':
                $sql = "SELECT p.*, tp.nombre AS tipo_programa_nombre,
                               (SELECT COUNT(*) FROM fichas f WHERE f.id_programa = p.id_programa) AS total_fichas,
                               (SELECT COUNT(*) FROM competencias c WHERE c.id_programa = p.id_programa) AS total_competencias
                        FROM programa p
                        INNER JOIN tipo_programa tp ON p.id_tipo_programa = tp.id_tipo_programa
                        ORDER BY p.nombre";
                break;

            case 'competencias':
                $sql = "SELECT c.*, p.nombre AS programa_nombre, c.id_programa,
                               (SELECT COUNT(*) FROM resultado_aprendizaje ra WHERE ra.id_competencia = c.id_competencia) AS total_resultados
                        FROM competencias c
                        INNER JOIN programa p ON c.id_programa = p.id_programa
                        ORDER BY p.nombre, c.codigo";
                break;

            case 'resultados':
                $sql = "SELECT ra.*, c.nombre AS competencia_nombre, c.codigo AS competencia_codigo, ra.id_competencia, p.nombre AS programa_nombre, c.id_programa
                        FROM resultado_aprendizaje ra
                        INNER JOIN competencias c ON ra.id_competencia = c.id_competencia
                        INNER JOIN programa p ON c.id_programa = p.id_programa
                        ORDER BY c.codigo, ra.codigo";
                break;

            case 'asistencias':
                $sql = "SELECT ast.*, 
                               CONCAT(u_ap.nombre, ' ', u_ap.apellido) AS aprendiz_nombre,
                               f.numero_ficha, f.id_programa,
                               CONCAT(u_ins.nombre, ' ', u_ins.apellido) AS instructor_nombre, pa.id_usuario as id_instructor,
                               c.nombre AS competencia_nombre, ra.id_competencia,
                               ra.codigo AS ra_codigo,
                               p.nombre AS programa_nombre
                        FROM asistencia ast
                        INNER JOIN programacion_academica pa ON ast.id_programacion = pa.id_programacion
                        INNER JOIN usuarios u_ap ON ast.id_usuario_aprendiz = u_ap.id_usuario
                        INNER JOIN fichas f ON pa.numero_ficha = f.numero_ficha
                        INNER JOIN usuarios u_ins ON pa.id_usuario = u_ins.id_usuario
                        INNER JOIN resultado_aprendizaje ra ON pa.id_resultado_aprendizaje = ra.id_resultado
                        INNER JOIN competencias c ON ra.id_competencia = c.id_competencia
                        INNER JOIN programa p ON f.id_programa = p.id_programa
                        ORDER BY ast.fecha_asistencia DESC, u_ap.nombre, u_ap.apellido";
                break;

            case 'novedades':
                $sql = "SELECT na.*, a.nombre AS ambiente_nombre, na.id_numero_ambiente, CONCAT(u.nombre, ' ', u.apellido) AS usuario_nombre, na.id_usuario as id_instructor
                        FROM novedad_ambiente na
                        INNER JOIN ambientes a ON na.id_numero_ambiente = a.id_numero_ambiente
                        INNER JOIN usuarios u ON na.id_usuario = u.id_usuario
                        ORDER BY na.fecha_reporte DESC";
                break;

            default:
                throw new Exception("Tipo de reporte no válido");
        }

        $db->query($sql);
        return $db->resultSet();
    }

    /**
     * Retorna la configuración de columnas y anchos para el reporte PDF/Excel
     */
    private function obtenerConfiguracionColumnas($tipo) {
        $config = ['columns' => []];

        switch ($tipo) {
            case 'programacion':
                $config['columns'] = [
                    ['title' => 'Ficha', 'width' => 20, 'align' => 'C', 'field' => 'numero_ficha'],
                    ['title' => 'Programa de Formacion', 'width' => 50, 'align' => 'L', 'field' => 'programa_nombre'],
                    ['title' => 'Instructor', 'width' => 40, 'align' => 'L', 'field' => 'instructor_nombre'],
                    ['title' => 'Ambiente', 'width' => 38, 'align' => 'L', 'field' => 'ambiente_nombre'],
                    ['title' => 'Dia', 'width' => 18, 'align' => 'C', 'field' => 'nombre_dia'],
                    ['title' => 'Horario', 'width' => 28, 'align' => 'C', 'field' => 'horario'],
                    ['title' => 'Competencia', 'width' => 53, 'align' => 'L', 'field' => 'competencia_nombre'],
                    ['title' => 'Sesiones', 'width' => 20, 'align' => 'C', 'field' => 'sesiones_prog']
                ];
                break;

            case 'instructores':
                $config['columns'] = [
                    ['title' => 'Nombre Completo', 'width' => 65, 'align' => 'L', 'field' => 'nombre_completo'],
                    ['title' => 'Correo Electronico', 'width' => 65, 'align' => 'L', 'field' => 'correo'],
                    ['title' => 'Contacto', 'width' => 30, 'align' => 'C', 'field' => 'telefono'],
                    ['title' => 'Titulacion / Especialidad', 'width' => 55, 'align' => 'L', 'field' => 'titulacion'],
                    ['title' => 'Prog. Asignadas', 'width' => 27, 'align' => 'C', 'field' => 'total_programaciones'],
                    ['title' => 'Fichas', 'width' => 25, 'align' => 'C', 'field' => 'total_fichas']
                ];
                break;

            case 'ambientes':
                $config['columns'] = [
                    ['title' => 'ID', 'width' => 15, 'align' => 'C', 'field' => 'id_numero_ambiente'],
                    ['title' => 'Nombre del Ambiente', 'width' => 55, 'align' => 'L', 'field' => 'nombre'],
                    ['title' => 'Tipo', 'width' => 35, 'align' => 'L', 'field' => 'tipo'],
                    ['title' => 'Capacidad', 'width' => 25, 'align' => 'C', 'field' => 'capacidad'],
                    ['title' => 'Computadores', 'width' => 30, 'align' => 'C', 'field' => 'computadores'],
                    ['title' => 'Equipamiento y Servicios', 'width' => 77, 'align' => 'L', 'field' => 'equipamiento'],
                    ['title' => 'Estado', 'width' => 30, 'align' => 'C', 'field' => 'disponibilidad']
                ];
                break;

            case 'fichas':
                $config['columns'] = [
                    ['title' => 'Ficha', 'width' => 22, 'align' => 'C', 'field' => 'numero_ficha'],
                    ['title' => 'Estudiantes', 'width' => 22, 'align' => 'C', 'field' => 'cantidad_estudiantes'],
                    ['title' => 'Fecha Inicio', 'width' => 28, 'align' => 'C', 'field' => 'fecha_inicio'],
                    ['title' => 'Etapa Practicas', 'width' => 28, 'align' => 'C', 'field' => 'fecha_practicas'],
                    ['title' => 'Fecha Fin', 'width' => 28, 'align' => 'C', 'field' => 'fecha_fin'],
                    ['title' => 'Instructor Lider', 'width' => 50, 'align' => 'L', 'field' => 'instructor_lider_nombre'],
                    ['title' => 'Programa Formativo', 'width' => 64, 'align' => 'L', 'field' => 'programa_nombre'],
                    ['title' => 'Jornada', 'width' => 25, 'align' => 'C', 'field' => 'jornada_nombre']
                ];
                break;

            case 'programas':
                $config['columns'] = [
                    ['title' => 'Codigo', 'width' => 25, 'align' => 'C', 'field' => 'codigo'],
                    ['title' => 'Nombre del Programa Formativo', 'width' => 92, 'align' => 'L', 'field' => 'nombre'],
                    ['title' => 'Version', 'width' => 20, 'align' => 'C', 'field' => 'version'],
                    ['title' => 'Vigencia', 'width' => 20, 'align' => 'C', 'field' => 'vigencia'],
                    ['title' => 'Dur. Lectiva', 'width' => 30, 'align' => 'C', 'field' => 'duracion_lectiva'],
                    ['title' => 'Dur. Practica', 'width' => 30, 'align' => 'C', 'field' => 'duracion_practica'],
                    ['title' => 'Tipo Programa', 'width' => 50, 'align' => 'C', 'field' => 'tipo_programa_nombre']
                ];
                break;

            case 'competencias':
                $config['columns'] = [
                    ['title' => 'Codigo', 'width' => 25, 'align' => 'C', 'field' => 'codigo'],
                    ['title' => 'Nombre de la Competencia', 'width' => 102, 'align' => 'L', 'field' => 'nombre'],
                    ['title' => 'Programa Formativo', 'width' => 70, 'align' => 'L', 'field' => 'programa_nombre'],
                    ['title' => 'Horas', 'width' => 20, 'align' => 'C', 'field' => 'horas_totales'],
                    ['title' => 'Resultados', 'width' => 25, 'align' => 'C', 'field' => 'resultados_totales'],
                    ['title' => 'Sesiones', 'width' => 25, 'align' => 'C', 'field' => 'total_sesiones']
                ];
                break;

            case 'resultados':
                $config['columns'] = [
                    ['title' => 'Codigo', 'width' => 25, 'align' => 'C', 'field' => 'codigo'],
                    ['title' => 'Descripcion del Resultado', 'width' => 102, 'align' => 'L', 'field' => 'descripcion'],
                    ['title' => 'Competencia Relacionada', 'width' => 75, 'align' => 'L', 'field' => 'competencia_nombre'],
                    ['title' => 'Programa', 'width' => 45, 'align' => 'L', 'field' => 'programa_nombre'],
                    ['title' => 'Sesiones', 'width' => 20, 'align' => 'C', 'field' => 'sesiones_asignadas']
                ];
                break;

            case 'asistencias':
                $config['columns'] = [
                    ['title' => 'Aprendiz', 'width' => 50, 'align' => 'L', 'field' => 'aprendiz_nombre'],
                    ['title' => 'Ficha', 'width' => 20, 'align' => 'C', 'field' => 'numero_ficha'],
                    ['title' => 'Instructor', 'width' => 40, 'align' => 'L', 'field' => 'instructor_nombre'],
                    ['title' => 'Fecha Control', 'width' => 25, 'align' => 'C', 'field' => 'fecha_asistencia'],
                    ['title' => 'Competencia', 'width' => 65, 'align' => 'L', 'field' => 'competencia_nombre'],
                    ['title' => 'Estado', 'width' => 27, 'align' => 'C', 'field' => 'asistio'],
                    ['title' => 'Observacion', 'width' => 40, 'align' => 'L', 'field' => 'observacion']
                ];
                break;

            case 'novedades':
                $config['columns'] = [
                    ['title' => 'ID', 'width' => 15, 'align' => 'C', 'field' => 'id_novedad'],
                    ['title' => 'Ambiente Fisico', 'width' => 45, 'align' => 'L', 'field' => 'ambiente_nombre'],
                    ['title' => 'Reportado Por', 'width' => 45, 'align' => 'L', 'field' => 'usuario_nombre'],
                    ['title' => 'Descripcion del Reporte / Averia', 'width' => 132, 'align' => 'L', 'field' => 'descripcion'],
                    ['title' => 'Fecha Reporte', 'width' => 30, 'align' => 'C', 'field' => 'fecha_reporte']
                ];
                break;
        }

        return $config;
    }

    /**
     * Obtiene el valor formateado de un objeto fila para las exportaciones
     */
    private function obtenerValorCampoPDF($tipo, $row, $field) {
        switch ($tipo) {
            case 'programacion':
                if ($field === 'horario') {
                    return substr($row->hora_inicio, 0, 5) . ' - ' . substr($row->hora_fin, 0, 5);
                }
                if ($field === 'sesiones_prog') {
                    return $row->sesiones_realizadas . ' / ' . $row->total_sesiones;
                }
                break;
            case 'instructores':
                if ($field === 'nombre_completo') {
                    return $row->nombre . ' ' . $row->apellido;
                }
                break;
            case 'ambientes':
                if ($field === 'equipamiento') {
                    $eq = [];
                    if ($row->aire) $eq[] = 'Aire Acond.';
                    if ($row->ventilador) $eq[] = 'Ventilador';
                    if ($row->tablero) $eq[] = 'Tablero';
                    if ($row->tv) $eq[] = 'TV';
                    return empty($eq) ? 'Ninguno' : implode(', ', $eq);
                }
                if ($field === 'disponibilidad') {
                    return $row->disponibilidad ? 'Disponible' : 'No Disp.';
                }
                break;
            case 'asistencias':
                if ($field === 'asistio') {
                    return $row->asistio ? 'Asistio' : 'Falto';
                }
                if ($field === 'observacion') {
                    return empty($row->observacion) ? 'Sin observaciones' : $row->observacion;
                }
                break;
        }

        return $row->$field ?? '';
    }
}

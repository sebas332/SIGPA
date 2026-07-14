<?php
/**
 * Controlador DashboardController
 * Carga las métricas, perfil del usuario y la pantalla principal según el rol activo.
 */
class DashboardController extends BaseController {
    private $fichaModel;
    private $ambienteModel;
    private $usuarioModel;
    private $programaModel;
    private $programacionModel;
    private $asistenciaModel;
    private $novedadModel;
    private $competenciaModel;
    private $resultadoModel;
    private $jornadaModel;
    private $rolModel;

    public function __construct() {
        $this->fichaModel = $this->model('Ficha');
        $this->ambienteModel = $this->model('Ambiente');
        $this->usuarioModel = $this->model('Usuario');
        $this->programaModel = $this->model('Programa');
        $this->programacionModel = $this->model('ProgramacionAcademica');
        $this->asistenciaModel = $this->model('Asistencia');
        $this->novedadModel = $this->model('NovedadAmbiente');
        $this->competenciaModel = $this->model('Competencia');
        $this->resultadoModel = $this->model('ResultadoAprendizaje');
        $this->jornadaModel = $this->model('Jornada');
        $this->rolModel = $this->model('Rol');
    }

    /**
     * Pantalla de inicio del Dashboard
     */
    public function index() {
        $this->requireLogin();

        $current_role = $_SESSION['current_role'] ?? 'Aprendiz';
        $user_id = $_SESSION['user_id'];

        // Obtener los datos completos del perfil del usuario logueado
        $usuarioActual = $this->usuarioModel->find($user_id);

        $data = [
            'titulo' => 'Panel de Control - ' . $current_role,
            'current_role' => $current_role,
            'usuario' => $usuarioActual,
            'fichas' => [],
            'ambientes' => [],
            'ambientes_count' => 0,
            'usuarios_count' => 0,
            'programas_count' => 0,
            'programacion' => [],
            'asistencias' => [],
            'novedades' => [],
            'competencias' => [],
            'resultados' => [],
            'aprendices' => [],
            'programas_fichas' => []
        ];

        // Mapeo de nombres de programa por ficha para enriquecer las tarjetas de Instructor y Aprendiz
        $todasFichas = $this->fichaModel->all();
        foreach ($todasFichas as $f) {
            $data['programas_fichas'][$f->numero_ficha] = $f->programa_nombre;
        }

        if ($current_role === 'Coordinador') {
            $data['fichas'] = $todasFichas;
            $data['ambientes'] = $this->ambienteModel->all();
            $data['ambientes_count'] = count($data['ambientes']);
            
            $data['fotos_ambientes'] = [];
            $fotoModel = $this->model('FotoAmbiente');
            foreach ($data['ambientes'] as $a) {
                $data['fotos_ambientes'][$a->id_numero_ambiente] = $fotoModel->getByAmbiente($a->id_numero_ambiente);
            }
            $data['usuarios_count'] = count($this->usuarioModel->all());
            $data['programas_count'] = count($this->programaModel->all());
            $novedadesAmbienteId = filter_input(INPUT_GET, 'novedades_ambiente', FILTER_VALIDATE_INT);
            if ($novedadesAmbienteId) {
                $ambienteNovedades = $this->ambienteModel->find($novedadesAmbienteId);
                if ($ambienteNovedades) {
                    $data['novedades'] = $this->novedadModel->getByAmbiente($novedadesAmbienteId);
                    $data['novedades_ambiente'] = $ambienteNovedades;
                } else {
                    $data['novedades'] = $this->novedadModel->all();
                    $_SESSION['flash_error'] = 'El ambiente seleccionado para filtrar novedades no existe.';
                }
            } else {
                $data['novedades'] = $this->novedadModel->all();
            }
            $data['programacion'] = $this->programacionModel->all();
            $data['competencias'] = $this->competenciaModel->all();
            $data['resultados'] = $this->resultadoModel->all();

            // Cargar listas para el Modal de Crear Ficha y Programas
            $data['programas'] = $this->programaModel->all();
            $data['jornadas'] = $this->jornadaModel->all();
            $data['tipos'] = $this->model('TipoPrograma')->all();
            $data['dias'] = $this->model('Dia')->all();
            
            $todosUsuarios = $this->usuarioModel->all();
            $instructores = [];
            $candidatos = [];
            foreach ($todosUsuarios as $u) {
                $roles = $this->usuarioModel->getRoles($u->id_usuario);
                foreach ($roles as $r) {
                    if ($r->nombre_rol === 'Instructor') {
                        $instructores[] = $u;
                    }
                    if ($r->nombre_rol === 'Aprendiz') {
                        $candidatos[] = $u;
                    }
                }
            }
            $data['instructores'] = $instructores;
            $data['candidatos'] = $candidatos;

            // Cargar datos para la pestaña de Gestión de Usuarios y Roles
            $data['usuarios'] = $todosUsuarios;
            $data['roles'] = $this->rolModel->all();
            $rolesUsuario = [];
            foreach ($todosUsuarios as $u) {
                $rolesUsuario[$u->id_usuario] = $this->usuarioModel->getRoles($u->id_usuario);
            }
            $data['rolesUsuario'] = $rolesUsuario;
        } elseif ($current_role === 'Instructor') {
            $data['fichas'] = $this->fichaModel->getByInstructor($user_id);
            $data['programacion'] = $this->programacionModel->getByInstructor($user_id);
            $data['ambientes'] = $this->ambienteModel->all();
            $data['ambientes_count'] = count($data['ambientes']);
            
            // Cargar aprendices agrupados por la sesión programada (ficha correspondiente) en formato JSON
            $aprendicesPorProgramacion = [];
            $asistenciasPorProgramacion = [];
            $fichaAprendizModel = $this->model('FichaAprendiz');
            foreach ($data['programacion'] as $prog) {
                $aprendicesPorProgramacion[$prog->id_programacion] = $fichaAprendizModel->getAprendicesPorFicha($prog->numero_ficha);
                $fechaSesion = $prog->fecha_inicio ?? date('Y-m-d');
                $asistenciasPorProgramacion[$prog->id_programacion][$fechaSesion] = $this->asistenciaModel->getPorProgramacionYFecha($prog->id_programacion, $fechaSesion);
            }
            $data['aprendicesPorProgramacion'] = json_encode($aprendicesPorProgramacion);
            $data['asistenciasPorProgramacion'] = json_encode($asistenciasPorProgramacion);

        } elseif ($current_role === 'Aprendiz') {
            $data['programacion'] = $this->programacionModel->getByAprendiz($user_id);
            $data['asistencias'] = $this->asistenciaModel->getPorAprendiz($user_id);
            
            $fichasDelAprendiz = $this->fichaModel->getByAprendiz($user_id);
            $mi_ficha = !empty($fichasDelAprendiz) ? $fichasDelAprendiz[0] : null;
            $data['mi_ficha'] = $mi_ficha;

            $progreso_raps = [];
            $total_sesiones_requeridas = 0;
            $total_horas_requeridas = 0;
            $sesiones_realizadas = 0;
            $horas_realizadas = 0;

            if ($mi_ficha) {
                // 1. Obtener programacion de esa ficha en particular (para sacar el progreso real)
                $programacion_ficha = $this->programacionModel->getByFicha($mi_ficha->numero_ficha);
                foreach ($programacion_ficha as $prog) {
                    $id_ra = (int) $prog->id_resultado_aprendizaje;
                    if (!isset($progreso_raps[$id_ra])) {
                        $progreso_raps[$id_ra] = [
                            'sesiones_realizadas' => (int)($prog->sesiones_realizadas ?? 0),
                            'total_sesiones' => (int)($prog->total_sesiones ?? 0),
                            'horas_realizadas' => (int)($prog->horas_realizadas ?? 0),
                            'total_horas' => (int)($prog->total_horas ?? 0)
                        ];
                        $sesiones_realizadas += $progreso_raps[$id_ra]['sesiones_realizadas'];
                        $horas_realizadas += $progreso_raps[$id_ra]['horas_realizadas'];
                    }
                }

                $data['competencias'] = $this->competenciaModel->getByPrograma($mi_ficha->id_programa);
                
                // 2. Obtener config
                $db = Database::getInstance();
                $db->query("SELECT id_resultado, sesiones_asignadas_ajustadas, horas_a_ejecutar_ajustadas FROM ficha_resultado_config WHERE numero_ficha = :ficha");
                $db->bind(':ficha', $mi_ficha->numero_ficha);
                $configs_raw = $db->resultSet();
                $config_ra_sesiones = [];
                $config_ra_horas = [];
                foreach($configs_raw as $c) {
                    $config_ra_sesiones[$c->id_resultado] = $c->sesiones_asignadas_ajustadas;
                    $config_ra_horas[$c->id_resultado] = $c->horas_a_ejecutar_ajustadas;
                }

                $data['resultados_programa'] = [];
                foreach ($data['competencias'] as $comp) {
                    $ras = $this->resultadoModel->getByCompetencia($comp->id_competencia);
                    foreach($ras as $ra) {
                        $ra->sesiones_requeridas = $config_ra_sesiones[$ra->id_resultado] ?? $ra->sesiones_asignadas ?? 0;
                        $ra->sesiones_realizadas = $progreso_raps[$ra->id_resultado]['sesiones_realizadas'] ?? 0;
                        $ra->sesiones_pendientes = max(0, $ra->sesiones_requeridas - $ra->sesiones_realizadas);
                        
                        $ra->horas_requeridas = $config_ra_horas[$ra->id_resultado] ?? ($ra->sesiones_requeridas * 6);
                        $ra->horas_realizadas = $progreso_raps[$ra->id_resultado]['horas_realizadas'] ?? 0;
                        $ra->horas_pendientes = max(0, $ra->horas_requeridas - $ra->horas_realizadas);
                        
                        $total_sesiones_requeridas += $ra->sesiones_requeridas;
                        $total_horas_requeridas += $ra->horas_requeridas;
                    }
                    $data['resultados_programa'][$comp->id_competencia] = $ras;
                }
            } else {
                $data['competencias'] = [];
                $data['resultados_programa'] = [];
            }
            
            $data['total_sesiones_requeridas'] = $total_sesiones_requeridas;
            $data['sesiones_realizadas'] = $sesiones_realizadas;
            $data['sesiones_pendientes'] = max(0, $total_sesiones_requeridas - $sesiones_realizadas);
            $data['porcentaje_avance'] = $total_sesiones_requeridas > 0 ? round(($sesiones_realizadas / $total_sesiones_requeridas) * 100) : 0;
            
            $data['total_horas_requeridas'] = $total_horas_requeridas;
            $data['horas_realizadas'] = $horas_realizadas;
            $data['horas_pendientes'] = max(0, $total_horas_requeridas - $horas_realizadas);
            $data['porcentaje_avance_horas'] = $total_horas_requeridas > 0 ? round(($horas_realizadas / $total_horas_requeridas) * 100) : 0;
            
            $data['progreso_raps'] = $progreso_raps;
            $data['resultados'] = $this->resultadoModel->all();
        }

        $data['excepciones'] = $this->novedadModel->getExcepcionesProgramacion();

        $this->render('dashboard/index', $data);
    }
}

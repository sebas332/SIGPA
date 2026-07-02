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
            $data['novedades'] = $this->novedadModel->all();
            $data['programacion'] = $this->programacionModel->all();
            $data['competencias'] = $this->competenciaModel->all();
            $data['resultados'] = $this->resultadoModel->all();

            // Cargar listas para el Modal de Crear Ficha y Programas
            $data['programas'] = $this->programaModel->all();
            $data['jornadas'] = $this->jornadaModel->all();
            $data['tipos'] = $this->model('TipoPrograma')->all();
            
            $todosUsuarios = $this->usuarioModel->all();
            $instructores = [];
            foreach ($todosUsuarios as $u) {
                $roles = $this->usuarioModel->getRoles($u->id_usuario);
                foreach ($roles as $r) {
                    if ($r->nombre_rol === 'Instructor') {
                        $instructores[] = $u;
                        break;
                    }
                }
            }
            $data['instructores'] = $instructores;

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
            
            // Cargar los aprendices para la planilla digital de asistencia verificando sus roles en la tabla usuario_rol
            $todosUsuarios = $this->usuarioModel->all();
            $listaApr = [];
            foreach ($todosUsuarios as $u) {
                $roles = $this->usuarioModel->getRoles($u->id_usuario);
                $esAprendiz = false;
                foreach ($roles as $r) {
                    if (stripos($r->nombre_rol, 'Aprendiz') !== false) {
                        $esAprendiz = true;
                        break;
                    }
                }
                if ($esAprendiz) {
                    $listaApr[] = $u;
                }
            }
            $data['aprendices'] = $listaApr;

        } elseif ($current_role === 'Aprendiz') {
            $data['programacion'] = $this->programacionModel->getByAprendiz($user_id);
            $data['asistencias'] = $this->asistenciaModel->getPorAprendiz($user_id);
            $data['competencias'] = $this->competenciaModel->all();
        }

        $this->render('dashboard/index', $data);
    }
}

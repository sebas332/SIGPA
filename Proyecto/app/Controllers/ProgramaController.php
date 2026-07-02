<?php
/**
 * Controlador ProgramaController
 * Gestiona los programas de formación, competencias y resultados de aprendizaje.
 */
class ProgramaController extends BaseController {
    private $programaModel;
    private $tipoProgramaModel;
    private $competenciaModel;
    private $resultadoModel;

    public function __construct() {
        $this->programaModel = $this->model('Programa');
        $this->tipoProgramaModel = $this->model('TipoPrograma');
        $this->competenciaModel = $this->model('Competencia');
        $this->resultadoModel = $this->model('ResultadoAprendizaje');
    }

    /**
     * Muestra el listado de programas, competencias y resultados
     */
    public function index() {
        $this->requireLogin();
        $programas = $this->programaModel->all();
        $tipos = $this->tipoProgramaModel->all();
        $competencias = $this->competenciaModel->all();
        $resultados = $this->resultadoModel->all();

        $this->render('programas/index', [
            'titulo' => 'Administración de Programas y Competencias',
            'programas' => $programas,
            'tipos' => $tipos,
            'competencias' => $competencias,
            'resultados' => $resultados,
            'current_role' => $_SESSION['current_role'] ?? 'Aprendiz'
        ]);
    }

    /**
     * Crear un nuevo programa de formación (Coordinador)
     */
    public function create() {
        $this->requireRol('Coordinador');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre' => $_POST['nombre'] ?? '',
                'codigo' => $_POST['codigo'] ?? '',
                'version' => $_POST['version'] ?? '',
                'vigencia' => $_POST['vigencia'] ?? '',
                'duracion_lectiva' => $_POST['duracion_lectiva'] ?? 0,
                'duracion_practica' => $_POST['duracion_practica'] ?? 0,
                'id_tipo_programa' => $_POST['id_tipo_programa'] ?? 0
            ];

            if ($this->programaModel->create($data)) {
                $_SESSION['flash_success'] = 'Programa de formación creado exitosamente.';
            } else {
                $_SESSION['flash_error'] = 'Error al crear el programa.';
            }
        }
        $this->redirect('dashboard/index#pills-programas');
    }

    /**
     * Actualizar un programa de formación (Coordinador)
     */
    public function update() {
        $this->requireRol('Coordinador');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_programa'] ?? 0;
            $data = [
                'nombre' => $_POST['nombre'] ?? '',
                'codigo' => $_POST['codigo'] ?? '',
                'version' => $_POST['version'] ?? '',
                'vigencia' => $_POST['vigencia'] ?? '',
                'duracion_lectiva' => $_POST['duracion_lectiva'] ?? 0,
                'duracion_practica' => $_POST['duracion_practica'] ?? 0,
                'id_tipo_programa' => $_POST['id_tipo_programa'] ?? 0
            ];

            if ($this->programaModel->update($id, $data)) {
                $_SESSION['flash_success'] = 'Programa actualizado exitosamente.';
            } else {
                $_SESSION['flash_error'] = 'Error al actualizar el programa.';
            }
        }
        $this->redirect('dashboard/index#pills-programas');
    }

    /**
     * Eliminar un programa de formación (Coordinador)
     */
    public function delete() {
        $this->requireRol('Coordinador');
        $id = $_GET['id'] ?? 0;
        if ($id > 0) {
            if ($this->programaModel->delete($id)) {
                $_SESSION['flash_success'] = 'Programa eliminado correctamente.';
            } else {
                $_SESSION['flash_error'] = 'Error al eliminar el programa. Es posible que existan fichas asignadas a este programa.';
            }
        }
        $this->redirect('dashboard/index#pills-programas');
    }

    /**
     * Crear una competencia (Coordinador)
     */
    public function createCompetencia() {
        $this->requireRol('Coordinador');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id_programa' => $_POST['id_programa'] ?? 0,
                'nombre' => $_POST['nombre'] ?? '',
                'codigo' => $_POST['codigo'] ?? '',
                'horas_totales' => $_POST['horas_totales'] ?? 0,
                'resultados_totales' => $_POST['resultados_totales'] ?? 0,
                'porcentaje' => $_POST['porcentaje'] ?? 100
            ];

            try {
                if ($this->competenciaModel->create($data)) {
                    $_SESSION['flash_success'] = 'Competencia registrada exitosamente.';
                } else {
                    $_SESSION['flash_error'] = 'Error al registrar la competencia.';
                }
            } catch (Exception $e) {
                $_SESSION['flash_error'] = 'Error en validación por Triggers: ' . $e->getMessage();
            }
        }
        $this->redirect('programas/index');
    }

    /**
     * Crear un resultado de aprendizaje (Coordinador)
     */
    public function createResultado() {
        $this->requireRol('Coordinador');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id_competencia' => $_POST['id_competencia'] ?? 0,
                'codigo' => $_POST['codigo'] ?? '',
                'descripcion' => $_POST['descripcion'] ?? '',
                'sesiones_asignadas' => $_POST['sesiones_asignadas'] !== '' ? $_POST['sesiones_asignadas'] : null
            ];

            try {
                if ($this->resultadoModel->create($data)) {
                    $_SESSION['flash_success'] = 'Resultado de aprendizaje registrado exitosamente.';
                } else {
                    $_SESSION['flash_error'] = 'Error al registrar el resultado.';
                }
            } catch (Exception $e) {
                $_SESSION['flash_error'] = 'Error en validación por Triggers: ' . $e->getMessage();
            }
        }
        $this->redirect('programas/index');
    }

    /**
     * Valida las sesiones de una competencia mediante el procedimiento almacenado sp_validar_sesiones_competencia
     */
    public function validarSesiones() {
        $this->requireRol('Coordinador');
        $id_competencia = $_GET['id'] ?? 0;

        $resultado = $this->competenciaModel->validarSesiones($id_competencia);
        if ($resultado['success']) {
            $_SESSION['flash_success'] = $resultado['message'];
        } else {
            $_SESSION['flash_error'] = 'Error en validación (SP): ' . $resultado['message'];
        }
        $this->redirect('programas/index');
    }
}

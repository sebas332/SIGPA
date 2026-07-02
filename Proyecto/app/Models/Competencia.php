<?php
/**
 * Modelo Competencia
 * Gestiona las operaciones CRUD de la tabla `competencias` y validación por SP.
 */
class Competencia {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    /**
     * Obtener todas las competencias con su respectivo programa
     * @return array
     */
    public function all() {
        $this->db->query("SELECT c.*, p.nombre as programa_nombre FROM competencias c 
                          INNER JOIN programa p ON c.id_programa = p.id_programa 
                          ORDER BY p.nombre, c.nombre");
        return $this->db->resultSet();
    }

    /**
     * Obtener competencias de un programa específico
     * @param int $id_programa
     * @return array
     */
    public function getByPrograma($id_programa) {
        $this->db->query("SELECT * FROM competencias WHERE id_programa = :id_programa ORDER BY nombre");
        $this->db->bind(':id_programa', $id_programa);
        return $this->db->resultSet();
    }

    /**
     * Obtener una competencia por ID
     * @param int $id
     * @return object|false
     */
    public function find($id) {
        $this->db->query("SELECT c.*, p.nombre as programa_nombre FROM competencias c 
                          INNER JOIN programa p ON c.id_programa = p.id_programa 
                          WHERE c.id_competencia = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    /**
     * Crear una nueva competencia
     * NOTA: Los triggers trg_competencias_bi calcularán horas_a_ejecutar y total_sesiones.
     * @param array $data
     * @return bool
     */
    public function create($data) {
        $this->db->query("INSERT INTO competencias (id_programa, nombre, codigo, horas_totales, resultados_totales, porcentaje) 
                          VALUES (:id_programa, :nombre, :codigo, :horas_totales, :resultados_totales, :porcentaje)");
        $this->db->bind(':id_programa', $data['id_programa']);
        $this->db->bind(':nombre', $data['nombre']);
        $this->db->bind(':codigo', $data['codigo']);
        $this->db->bind(':horas_totales', $data['horas_totales']);
        $this->db->bind(':resultados_totales', $data['resultados_totales']);
        $this->db->bind(':porcentaje', $data['porcentaje']);
        return $this->db->execute();
    }

    /**
     * Actualizar una competencia
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, $data) {
        $this->db->query("UPDATE competencias SET id_programa = :id_programa, nombre = :nombre, codigo = :codigo, 
                          horas_totales = :horas_totales, resultados_totales = :resultados_totales, porcentaje = :porcentaje 
                          WHERE id_competencia = :id");
        $this->db->bind(':id_programa', $data['id_programa']);
        $this->db->bind(':nombre', $data['nombre']);
        $this->db->bind(':codigo', $data['codigo']);
        $this->db->bind(':horas_totales', $data['horas_totales']);
        $this->db->bind(':resultados_totales', $data['resultados_totales']);
        $this->db->bind(':porcentaje', $data['porcentaje']);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    /**
     * Eliminar una competencia
     * @param int $id
     * @return bool
     */
    public function delete($id) {
        $this->db->query("DELETE FROM competencias WHERE id_competencia = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    /**
     * Ejecutar el procedimiento almacenado sp_validar_sesiones_competencia
     * @param int $id_competencia
     * @return array [success => bool, message => string]
     */
    public function validarSesiones($id_competencia) {
        try {
            $this->db->query("CALL sp_validar_sesiones_competencia(:id_competencia)");
            $this->db->bind(':id_competencia', $id_competencia);
            $this->db->execute();
            return ['success' => true, 'message' => 'Las sesiones asignadas coinciden correctamente con el total de la competencia.'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}

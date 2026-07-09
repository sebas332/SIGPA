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
        $this->db->query("SELECT * FROM competencias ORDER BY nombre");
        return $this->db->resultSet();
    }

    /**
     * Obtener competencias de un programa específico
     * @param int $id_programa
     * @return array
     */
    public function getByPrograma($id_programa) {
        $this->db->query("
            SELECT c.* 
            FROM competencias c
            INNER JOIN programa_competencia pc ON c.id_competencia = pc.id_competencia
            WHERE pc.id_programa = :id_programa 
            ORDER BY c.nombre
        ");
        $this->db->bind(':id_programa', $id_programa);
        return $this->db->resultSet();
    }

    /**
     * Obtener una competencia por ID
     * @param int $id
     * @return object|false
     */
    public function find($id) {
        $this->db->query("SELECT * FROM competencias WHERE id_competencia = :id");
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
        $this->db->query("INSERT INTO competencias (nombre, codigo, horas_totales, resultados_totales, porcentaje) 
                          VALUES (:nombre, :codigo, :horas_totales, :resultados_totales, :porcentaje)");
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
        $this->db->query("UPDATE competencias SET nombre = :nombre, codigo = :codigo, 
                          horas_totales = :horas_totales, resultados_totales = :resultados_totales, porcentaje = :porcentaje 
                          WHERE id_competencia = :id");
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
            // Obtener total_sesiones de la competencia
            $this->db->query("SELECT total_sesiones FROM competencias WHERE id_competencia = :id");
            $this->db->bind(':id', $id_competencia);
            $comp = $this->db->single();
            $total_sesiones = $comp ? $comp->total_sesiones : 0;

            // Obtener suma de sesiones asignadas de los resultados
            $this->db->query("SELECT SUM(sesiones_asignadas) as suma FROM resultado_aprendizaje WHERE id_competencia = :id");
            $this->db->bind(':id', $id_competencia);
            $res = $this->db->single();
            $suma_sesiones = $res ? ($res->suma ?? 0) : 0;

            if ($suma_sesiones != $total_sesiones) {
                return ['success' => false, 'message' => 'La suma final de sesiones asignadas (' . $suma_sesiones . ') debe ser igual al total de sesiones de la competencia (' . $total_sesiones . ').'];
            }
            return ['success' => true, 'message' => 'Las sesiones asignadas coinciden correctamente con el total de la competencia.'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Obtener el último ID de competencia insertado
     * @return int
     */
    public function getLastInsertId() {
        return $this->db->lastInsertId();
    }
}

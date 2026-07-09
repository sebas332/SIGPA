<?php
/**
 * Modelo ResultadoAprendizaje
 * Gestiona las operaciones CRUD de la tabla `resultado_aprendizaje`.
 */
class ResultadoAprendizaje {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    /**
     * Obtener todos los resultados de aprendizaje con su competencia
     * @return array
     */
    public function all() {
        $this->db->query("SELECT ra.*, c.nombre as competencia_nombre FROM resultado_aprendizaje ra 
                          INNER JOIN competencias c ON ra.id_competencia = c.id_competencia 
                          ORDER BY c.nombre, ra.codigo");
        return $this->db->resultSet();
    }

    /**
     * Obtener resultados de aprendizaje por competencia
     * @param int $id_competencia
     * @return array
     */
    public function getByCompetencia($id_competencia) {
        $this->db->query("SELECT * FROM resultado_aprendizaje WHERE id_competencia = :id_competencia ORDER BY codigo");
        $this->db->bind(':id_competencia', $id_competencia);
        return $this->db->resultSet();
    }

    /**
     * Obtener un resultado de aprendizaje por ID
     * @param int $id
     * @return object|false
     */
    public function find($id) {
        $this->db->query("SELECT ra.*, c.nombre as competencia_nombre FROM resultado_aprendizaje ra 
                          INNER JOIN competencias c ON ra.id_competencia = c.id_competencia 
                          WHERE ra.id_resultado = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    /**
     * Crear un nuevo resultado de aprendizaje
     * @param array $data
     * @return bool
     */
    public function create($data) {
        $this->db->query("INSERT INTO resultado_aprendizaje (id_competencia, codigo, descripcion, sesiones_asignadas) 
                          VALUES (:id_competencia, :codigo, :descripcion, :sesiones_asignadas)");
        $this->db->bind(':id_competencia', $data['id_competencia']);
        $this->db->bind(':codigo', $data['codigo']);
        $this->db->bind(':descripcion', $data['descripcion']);
        $this->db->bind(':sesiones_asignadas', empty($data['sesiones_asignadas']) ? null : $data['sesiones_asignadas']);
        return $this->db->execute();
    }

    /**
     * Actualizar un resultado de aprendizaje
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, $data) {
        $this->db->query("UPDATE resultado_aprendizaje SET id_competencia = :id_competencia, codigo = :codigo, 
                          descripcion = :descripcion, sesiones_asignadas = :sesiones_asignadas 
                          WHERE id_resultado = :id");
        $this->db->bind(':id_competencia', $data['id_competencia']);
        $this->db->bind(':codigo', $data['codigo']);
        $this->db->bind(':descripcion', $data['descripcion']);
        $this->db->bind(':sesiones_asignadas', $data['sesiones_asignadas']);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    /**
     * Eliminar un resultado de aprendizaje
     * @param int $id
     * @return bool
     */
    public function delete($id) {
        $this->db->query("DELETE FROM resultado_aprendizaje WHERE id_resultado = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    /**
     * Obtener resultados de aprendizaje de un programa específico mediante JOIN con competencias
     * @param int $id_programa
     * @return array
     */
    public function getByPrograma($id_programa) {
        $this->db->query("SELECT ra.* FROM resultado_aprendizaje ra 
                          INNER JOIN competencias c ON ra.id_competencia = c.id_competencia 
                          INNER JOIN programa_competencia pc ON c.id_competencia = pc.id_competencia
                          WHERE pc.id_programa = :id_programa 
                          ORDER BY ra.codigo");
        $this->db->bind(':id_programa', $id_programa);
        return $this->db->resultSet();
    }

    /**
     * Obtener el último ID insertado
     * @return int
     */
    public function getLastInsertId() {
        return $this->db->lastInsertId();
    }
}

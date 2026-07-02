<?php
/**
 * Modelo Jornada
 * Gestiona las operaciones CRUD de la tabla `jornada`.
 */
class Jornada {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    /**
     * Obtener todas las jornadas
     * @return array
     */
    public function all() {
        $this->db->query("SELECT * FROM jornada ORDER BY id_jornada");
        return $this->db->resultSet();
    }

    /**
     * Obtener una jornada por ID
     * @param int $id
     * @return object|false
     */
    public function find($id) {
        $this->db->query("SELECT * FROM jornada WHERE id_jornada = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    /**
     * Crear una nueva jornada
     * @param array $data
     * @return bool
     */
    public function create($data) {
        $this->db->query("INSERT INTO jornada (nombre, hora_inicio, hora_fin) VALUES (:nombre, :hora_inicio, :hora_fin)");
        $this->db->bind(':nombre', $data['nombre']);
        $this->db->bind(':hora_inicio', $data['hora_inicio']);
        $this->db->bind(':hora_fin', $data['hora_fin']);
        return $this->db->execute();
    }

    /**
     * Actualizar una jornada
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, $data) {
        $this->db->query("UPDATE jornada SET nombre = :nombre, hora_inicio = :hora_inicio, hora_fin = :hora_fin WHERE id_jornada = :id");
        $this->db->bind(':nombre', $data['nombre']);
        $this->db->bind(':hora_inicio', $data['hora_inicio']);
        $this->db->bind(':hora_fin', $data['hora_fin']);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    /**
     * Eliminar una jornada
     * @param int $id
     * @return bool
     */
    public function delete($id) {
        $this->db->query("DELETE FROM jornada WHERE id_jornada = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}

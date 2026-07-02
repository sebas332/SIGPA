<?php
/**
 * Modelo TipoPrograma
 * Gestiona las operaciones CRUD de la tabla `tipo_programa`.
 */
class TipoPrograma {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    /**
     * Obtener todos los tipos de programa
     * @return array
     */
    public function all() {
        $this->db->query("SELECT * FROM tipo_programa ORDER BY id_tipo_programa");
        return $this->db->resultSet();
    }

    /**
     * Obtener un tipo por ID
     * @param int $id
     * @return object|false
     */
    public function find($id) {
        $this->db->query("SELECT * FROM tipo_programa WHERE id_tipo_programa = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    /**
     * Crear un nuevo tipo de programa
     * @param array $data
     * @return bool
     */
    public function create($data) {
        $this->db->query("INSERT INTO tipo_programa (nombre) VALUES (:nombre)");
        $this->db->bind(':nombre', $data['nombre']);
        return $this->db->execute();
    }

    /**
     * Actualizar un tipo de programa
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, $data) {
        $this->db->query("UPDATE tipo_programa SET nombre = :nombre WHERE id_tipo_programa = :id");
        $this->db->bind(':nombre', $data['nombre']);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    /**
     * Eliminar un tipo de programa
     * @param int $id
     * @return bool
     */
    public function delete($id) {
        $this->db->query("DELETE FROM tipo_programa WHERE id_tipo_programa = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}

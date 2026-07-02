<?php
/**
 * Modelo Dia
 * Gestiona las operaciones CRUD de la tabla `dias`.
 */
class Dia {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    /**
     * Obtener todos los días
     * @return array
     */
    public function all() {
        $this->db->query("SELECT * FROM dias ORDER BY id_dias");
        return $this->db->resultSet();
    }

    /**
     * Obtener un día por ID
     * @param int $id
     * @return object|false
     */
    public function find($id) {
        $this->db->query("SELECT * FROM dias WHERE id_dias = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
}

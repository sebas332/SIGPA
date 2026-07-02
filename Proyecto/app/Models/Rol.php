<?php
/**
 * Modelo Rol
 * Gestiona las operaciones CRUD de la tabla `rol`.
 */
class Rol {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    /**
     * Obtener todos los roles
     * @return array
     */
    public function all() {
        $this->db->query("SELECT * FROM rol ORDER BY id_rol");
        return $this->db->resultSet();
    }

    /**
     * Obtener un rol por ID
     * @param int $id
     * @return object|false
     */
    public function find($id) {
        $this->db->query("SELECT * FROM rol WHERE id_rol = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    /**
     * Crear un nuevo rol
     * @param array $data
     * @return bool
     */
    public function create($data) {
        $this->db->query("INSERT INTO rol (nombre_rol) VALUES (:nombre_rol)");
        $this->db->bind(':nombre_rol', $data['nombre_rol']);
        return $this->db->execute();
    }

    /**
     * Actualizar un rol existente
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, $data) {
        $this->db->query("UPDATE rol SET nombre_rol = :nombre_rol WHERE id_rol = :id");
        $this->db->bind(':nombre_rol', $data['nombre_rol']);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    /**
     * Eliminar un rol
     * @param int $id
     * @return bool
     */
    public function delete($id) {
        $this->db->query("DELETE FROM rol WHERE id_rol = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}

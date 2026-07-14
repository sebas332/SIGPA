<?php
/**
 * Modelo UsuarioRol
 * Gestiona las operaciones CRUD y asignaciones en la tabla `usuario_rol`.
 */
class UsuarioRol {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    /**
     * Obtener todas las asignaciones de usuario y rol
     * @return array
     */
    public function all() {
        $this->db->query("SELECT ur.*, u.nombre, u.apellido, u.usuario, r.nombre_rol 
                          FROM usuario_rol ur 
                          INNER JOIN usuarios u ON ur.id_usuario = u.id_usuario 
                          INNER JOIN rol r ON ur.id_rol = r.id_rol 
                          ORDER BY u.nombre, u.apellido");
        return $this->db->resultSet();
    }

    /**
     * Obtener los roles de un usuario
     * @param int $id_usuario
     * @return array
     */
    public function getRolesByUsuario($id_usuario) {
        $this->db->query("SELECT id_rol FROM usuario_rol WHERE id_usuario = :id_usuario");
        $this->db->bind(':id_usuario', $id_usuario);
        $result = $this->db->resultSet();
        $roles = [];
        foreach($result as $r) {
            $roles[] = $r->id_rol;
        }
        return $roles;
    }

    /**
     * Obtener una asignación por ID
     * @param int $id
     * @return object|false
     */
    public function find($id) {
        $this->db->query("SELECT * FROM usuario_rol WHERE id_usuario_rol = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    /**
     * Asignar un rol a un usuario
     * @param int $id_usuario
     * @param int $id_rol
     * @return bool
     */
    public function create($id_usuario, $id_rol) {
        // Verificar si ya existe la asignación
        $this->db->query("SELECT * FROM usuario_rol WHERE id_usuario = :id_usuario AND id_rol = :id_rol");
        $this->db->bind(':id_usuario', $id_usuario);
        $this->db->bind(':id_rol', $id_rol);
        if ($this->db->single()) {
            return false; // Ya asignado
        }

        $this->db->query("INSERT INTO usuario_rol (id_usuario, id_rol) VALUES (:id_usuario, :id_rol)");
        $this->db->bind(':id_usuario', $id_usuario);
        $this->db->bind(':id_rol', $id_rol);
        return $this->db->execute();
    }

    /**
     * Eliminar una asignación de rol
     * @param int $id
     * @return bool
     */
    public function delete($id) {
        $this->db->query("DELETE FROM usuario_rol WHERE id_usuario_rol = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    /**
     * Eliminar todos los roles de un usuario
     * @param int $id_usuario
     * @return bool
     */
    public function deleteByUsuario($id_usuario) {
        $this->db->query("DELETE FROM usuario_rol WHERE id_usuario = :id_usuario");
        $this->db->bind(':id_usuario', $id_usuario);
        return $this->db->execute();
    }
}

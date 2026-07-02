<?php
/**
 * Modelo FotoAmbiente
 * Gestiona las operaciones CRUD de la tabla `foto_ambiente`.
 */
class FotoAmbiente {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    /**
     * Obtener todas las fotos con nombre del ambiente
     * @return array
     */
    public function all() {
        $this->db->query("SELECT fa.*, a.nombre as ambiente_nombre FROM foto_ambiente fa 
                          INNER JOIN ambientes a ON fa.id_numero_ambiente = a.id_numero_ambiente 
                          ORDER BY a.nombre");
        return $this->db->resultSet();
    }

    /**
     * Obtener las fotos de un ambiente específico
     * @param int $id_numero_ambiente
     * @return array
     */
    public function getByAmbiente($id_numero_ambiente) {
        $this->db->query("SELECT * FROM foto_ambiente WHERE id_numero_ambiente = :id_numero_ambiente");
        $this->db->bind(':id_numero_ambiente', $id_numero_ambiente);
        return $this->db->resultSet();
    }

    /**
     * Obtener una foto por su ID
     * @param int $id
     * @return object|false
     */
    public function find($id) {
        $this->db->query("SELECT * FROM foto_ambiente WHERE id_foto_ambiente = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    /**
     * Crear una nueva foto para un ambiente
     * @param array $data
     * @return bool
     */
    public function create($data) {
        $this->db->query("INSERT INTO foto_ambiente (id_numero_ambiente, url, fecha_recarga) 
                          VALUES (:id_numero_ambiente, :url, :fecha_recarga)");
        $this->db->bind(':id_numero_ambiente', $data['id_numero_ambiente']);
        $this->db->bind(':url', $data['url']);
        $this->db->bind(':fecha_recarga', empty($data['fecha_recarga']) ? date('Y-m-d') : $data['fecha_recarga']);
        return $this->db->execute();
    }

    /**
     * Eliminar una foto
     * @param int $id
     * @return bool
     */
    public function delete($id) {
        $this->db->query("DELETE FROM foto_ambiente WHERE id_foto_ambiente = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}

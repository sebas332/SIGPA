<?php
/**
 * Modelo NovedadAmbiente
 * Gestiona las operaciones CRUD de la tabla `novedad_ambiente`.
 */
class NovedadAmbiente {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    /**
     * Obtener todas las novedades con los datos del ambiente y del usuario que reporta
     * @return array
     */
    public function all() {
        $this->db->query("SELECT na.*, a.nombre as ambiente_nombre, u.nombre as usuario_nombre, u.apellido as usuario_apellido 
                          FROM novedad_ambiente na 
                          INNER JOIN ambientes a ON na.id_numero_ambiente = a.id_numero_ambiente 
                          INNER JOIN usuarios u ON na.id_usuario = u.id_usuario 
                          ORDER BY na.fecha_reporte DESC");
        return $this->db->resultSet();
    }

    /**
     * Obtener las novedades de un ambiente específico
     * @param int $id_numero_ambiente
     * @return array
     */
    public function getByAmbiente($id_numero_ambiente) {
        $this->db->query("SELECT na.*, u.nombre as usuario_nombre, u.apellido as usuario_apellido 
                          FROM novedad_ambiente na 
                          INNER JOIN usuarios u ON na.id_usuario = u.id_usuario 
                          WHERE na.id_numero_ambiente = :id_numero_ambiente 
                          ORDER BY na.fecha_reporte DESC");
        $this->db->bind(':id_numero_ambiente', $id_numero_ambiente);
        return $this->db->resultSet();
    }

    /**
     * Obtener una novedad por ID
     * @param int $id
     * @return object|false
     */
    public function find($id) {
        $this->db->query("SELECT * FROM novedad_ambiente WHERE id_novedad = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    /**
     * Crear una novedad / reporte en un ambiente
     * @param array $data
     * @return bool
     */
    public function create($data) {
        $this->db->query("INSERT INTO novedad_ambiente (id_numero_ambiente, id_usuario, descripcion, fecha_reporte) 
                          VALUES (:id_numero_ambiente, :id_usuario, :descripcion, :fecha_reporte)");
        $this->db->bind(':id_numero_ambiente', $data['id_numero_ambiente']);
        $this->db->bind(':id_usuario', $data['id_usuario']);
        $this->db->bind(':descripcion', $data['descripcion']);
        $this->db->bind(':fecha_reporte', empty($data['fecha_reporte']) ? date('Y-m-d') : $data['fecha_reporte']);
        return $this->db->execute();
    }

    /**
     * Eliminar una novedad
     * @param int $id
     * @return bool
     */
    public function delete($id) {
        $this->db->query("DELETE FROM novedad_ambiente WHERE id_novedad = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    /**
     * Obtener todas las novedades de programación (ambientes liberados)
     * @return array
     */
    public function getExcepcionesProgramacion() {
        $this->db->query("SELECT * FROM novedad_ambiente WHERE descripcion LIKE '[LIBERADO_PROG:%'");
        return $this->db->resultSet();
    }
}

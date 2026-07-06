<?php
/**
 * Modelo FichaAprendiz
 * Gestiona la tabla asociativa `ficha_aprendiz`.
 */
class FichaAprendiz {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    /**
     * Obtener todos los aprendices inscritos en una ficha específica
     * @param int $numero_ficha
     * @return array
     */
    public function getAprendicesPorFicha($numero_ficha) {
        $this->db->query("SELECT fa.*, u.nombre, u.apellido, u.correo, u.telefono, u.documento, u.foto 
                          FROM ficha_aprendiz fa 
                          INNER JOIN usuarios u ON fa.id_usuario_aprendiz = u.id_usuario 
                          WHERE fa.numero_ficha = :numero_ficha 
                          ORDER BY u.nombre, u.apellido");
        $this->db->bind(':numero_ficha', $numero_ficha);
        return $this->db->resultSet();
    }

    /**
     * Inscribir un aprendiz en una ficha
     * @param int $id_usuario_aprendiz
     * @param int $numero_ficha
     * @return bool
     */
    public function create($id_usuario_aprendiz, $numero_ficha) {
        // Validar si ya está inscrito en CUALQUIER ficha
        $this->db->query("SELECT * FROM ficha_aprendiz WHERE id_usuario_aprendiz = :id_aprendiz");
        $this->db->bind(':id_aprendiz', $id_usuario_aprendiz);
        if ($this->db->single()) {
            return false; // Ya inscrito en una ficha
        }

        $this->db->query("INSERT INTO ficha_aprendiz (id_usuario_aprendiz, numero_ficha) VALUES (:id_aprendiz, :numero_ficha)");
        $this->db->bind(':id_aprendiz', $id_usuario_aprendiz);
        $this->db->bind(':numero_ficha', $numero_ficha);
        return $this->db->execute();
    }

    /**
     * Eliminar la inscripción de un aprendiz en una ficha
     * @param int $id_ficha_aprendiz
     * @return bool
     */
    public function delete($id_ficha_aprendiz) {
        $this->db->query("DELETE FROM ficha_aprendiz WHERE id_ficha_aprendiz = :id");
        $this->db->bind(':id', $id_ficha_aprendiz);
        return $this->db->execute();
    }
}

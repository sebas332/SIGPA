<?php
/**
 * Modelo Ficha
 * Gestiona las operaciones CRUD y relaciones de la tabla `fichas`.
 */
class Ficha {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    /**
     * Obtener todas las fichas con detalles del programa, jornada e instructor líder
     * @return array
     */
    public function all() {
        $this->db->query("SELECT f.*, p.nombre as programa_nombre, j.nombre as jornada_nombre, 
                          u.nombre as instructor_nombre, u.apellido as instructor_apellido 
                          FROM fichas f 
                          INNER JOIN programa p ON f.id_programa = p.id_programa 
                          INNER JOIN jornada j ON f.id_jornada = j.id_jornada 
                          INNER JOIN usuarios u ON f.id_usuario_instructor_lider = u.id_usuario 
                          ORDER BY f.numero_ficha");
        return $this->db->resultSet();
    }

    /**
     * Obtener fichas asignadas a un instructor líder
     * @param int $id_instructor
     * @return array
     */
    public function getByInstructor($id_instructor) {
        $this->db->query("SELECT f.*, p.nombre as programa_nombre, j.nombre as jornada_nombre, 
                          u.nombre as instructor_nombre, u.apellido as instructor_apellido 
                          FROM fichas f 
                          INNER JOIN programa p ON f.id_programa = p.id_programa 
                          INNER JOIN jornada j ON f.id_jornada = j.id_jornada 
                          INNER JOIN usuarios u ON f.id_usuario_instructor_lider = u.id_usuario 
                          WHERE f.id_usuario_instructor_lider = :id_instructor 
                          ORDER BY f.numero_ficha");
        $this->db->bind(':id_instructor', $id_instructor);
        return $this->db->resultSet();
    }

    /**
     * Obtener fichas donde un aprendiz está matriculado
     * @param int $id_aprendiz
     * @return array
     */
    public function getByAprendiz($id_aprendiz) {
        $this->db->query("SELECT f.*, p.nombre as programa_nombre, j.nombre as jornada_nombre, 
                          u.nombre as instructor_nombre, u.apellido as instructor_apellido 
                          FROM fichas f 
                          INNER JOIN programa p ON f.id_programa = p.id_programa 
                          INNER JOIN jornada j ON f.id_jornada = j.id_jornada 
                          INNER JOIN usuarios u ON f.id_usuario_instructor_lider = u.id_usuario 
                          INNER JOIN ficha_aprendiz fa ON f.numero_ficha = fa.numero_ficha 
                          WHERE fa.id_usuario_aprendiz = :id_aprendiz 
                          ORDER BY f.numero_ficha");
        $this->db->bind(':id_aprendiz', $id_aprendiz);
        return $this->db->resultSet();
    }

    /**
     * Obtener una ficha por su número
     * @param int $numero_ficha
     * @return object|false
     */
    public function find($numero_ficha) {
        $this->db->query("SELECT f.*, p.nombre as programa_nombre, j.nombre as jornada_nombre, 
                          u.nombre as instructor_nombre, u.apellido as instructor_apellido 
                          FROM fichas f 
                          INNER JOIN programa p ON f.id_programa = p.id_programa 
                          INNER JOIN jornada j ON f.id_jornada = j.id_jornada 
                          INNER JOIN usuarios u ON f.id_usuario_instructor_lider = u.id_usuario 
                          WHERE f.numero_ficha = :numero_ficha");
        $this->db->bind(':numero_ficha', $numero_ficha);
        return $this->db->single();
    }

    /**
     * Crear una nueva ficha
     * @param array $data
     * @return bool
     */
    public function create($data) {
        $this->db->query("INSERT INTO fichas (numero_ficha, cantidad_estudiantes, fecha_inicio, fecha_practicas, fecha_fin, id_usuario_instructor_lider, id_programa, id_jornada) 
                          VALUES (:numero_ficha, :cantidad_estudiantes, :fecha_inicio, :fecha_practicas, :fecha_fin, :id_usuario_instructor_lider, :id_programa, :id_jornada)");
        $this->db->bind(':numero_ficha', $data['numero_ficha']);
        $this->db->bind(':cantidad_estudiantes', $data['cantidad_estudiantes']);
        $this->db->bind(':fecha_inicio', $data['fecha_inicio']);
        $this->db->bind(':fecha_practicas', $data['fecha_practicas']);
        $this->db->bind(':fecha_fin', $data['fecha_fin']);
        $this->db->bind(':id_usuario_instructor_lider', $data['id_usuario_instructor_lider']);
        $this->db->bind(':id_programa', $data['id_programa']);
        $this->db->bind(':id_jornada', $data['id_jornada']);
        return $this->db->execute();
    }

    /**
     * Actualizar una ficha existente
     * @param int $numero_ficha
     * @param array $data
     * @return bool
     */
    public function update($numero_ficha, $data) {
        $this->db->query("UPDATE fichas SET cantidad_estudiantes = :cantidad_estudiantes, fecha_inicio = :fecha_inicio, 
                          fecha_practicas = :fecha_practicas, fecha_fin = :fecha_fin, id_usuario_instructor_lider = :id_usuario_instructor_lider, 
                          id_programa = :id_programa, id_jornada = :id_jornada WHERE numero_ficha = :numero_ficha");
        $this->db->bind(':cantidad_estudiantes', $data['cantidad_estudiantes']);
        $this->db->bind(':fecha_inicio', $data['fecha_inicio']);
        $this->db->bind(':fecha_practicas', $data['fecha_practicas']);
        $this->db->bind(':fecha_fin', $data['fecha_fin']);
        $this->db->bind(':id_usuario_instructor_lider', $data['id_usuario_instructor_lider']);
        $this->db->bind(':id_programa', $data['id_programa']);
        $this->db->bind(':id_jornada', $data['id_jornada']);
        $this->db->bind(':numero_ficha', $numero_ficha);
        return $this->db->execute();
    }

    /**
     * Eliminar una ficha
     * @param int $numero_ficha
     * @return bool
     */
    public function delete($numero_ficha) {
        $this->db->query("DELETE FROM fichas WHERE numero_ficha = :numero_ficha");
        $this->db->bind(':numero_ficha', $numero_ficha);
        return $this->db->execute();
    }
}

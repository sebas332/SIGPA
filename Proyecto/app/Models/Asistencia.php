<?php
/**
 * Modelo Asistencia
 * Gestiona el registro y consulta de la tabla `asistencia`.
 */
class Asistencia {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    /**
     * Obtener las asistencias registradas para una programación y fecha específica
     * @param int $id_programacion
     * @param string $fecha
     * @return array
     */
    public function getPorProgramacionYFecha($id_programacion, $fecha) {
        $this->db->query("SELECT a.*, u.nombre, u.apellido, u.correo, u.documento
                          FROM asistencia a 
                          INNER JOIN usuarios u ON a.id_usuario_aprendiz = u.id_usuario 
                          WHERE a.id_programacion = :id_programacion AND a.fecha_asistencia = :fecha 
                          ORDER BY u.nombre, u.apellido");
        $this->db->bind(':id_programacion', $id_programacion);
        $this->db->bind(':fecha', $fecha);
        return $this->db->resultSet();
    }

    /**
     * Obtener historial de asistencia de un aprendiz
     * @param int $id_aprendiz
     * @return array
     */
    public function getPorAprendiz($id_aprendiz) {
        $this->db->query("SELECT a.*, pa.fecha_inicio, pa.hora_inicio, pa.hora_fin, 
                          f.numero_ficha, p.nombre as programa_nombre, c.nombre as competencia_nombre, 
                          ra.codigo as ra_codigo, amb.nombre as ambiente_nombre,
                          u.nombre as instructor_nombre, u.apellido as instructor_apellido 
                          FROM asistencia a 
                          INNER JOIN programacion_academica pa ON a.id_programacion = pa.id_programacion 
                          INNER JOIN fichas f ON pa.numero_ficha = f.numero_ficha 
                          INNER JOIN programa p ON f.id_programa = p.id_programa
                          INNER JOIN ambientes amb ON pa.id_numero_ambiente = amb.id_numero_ambiente
                          INNER JOIN resultado_aprendizaje ra ON pa.id_resultado_aprendizaje = ra.id_resultado 
                          INNER JOIN competencias c ON ra.id_competencia = c.id_competencia 
                          INNER JOIN usuarios u ON pa.id_usuario = u.id_usuario 
                          WHERE a.id_usuario_aprendiz = :id_aprendiz 
                          ORDER BY a.fecha_asistencia DESC, pa.hora_inicio DESC");
        $this->db->bind(':id_aprendiz', $id_aprendiz);
        return $this->db->resultSet();
    }

    /**
     * Obtener todas las asistencias (para el rol Coordinador)
     * @return array
     */
    public function all() {
        $this->db->query("SELECT a.*, pa.fecha_inicio, pa.hora_inicio, pa.hora_fin, 
                          f.numero_ficha, c.nombre as competencia_nombre, 
                          u.nombre as aprendiz_nombre, u.apellido as aprendiz_apellido, 
                          inst.nombre as instructor_nombre, inst.apellido as instructor_apellido 
                          FROM asistencia a 
                          INNER JOIN programacion_academica pa ON a.id_programacion = pa.id_programacion 
                          INNER JOIN fichas f ON pa.numero_ficha = f.numero_ficha 
                          INNER JOIN resultado_aprendizaje ra ON pa.id_resultado_aprendizaje = ra.id_resultado 
                          INNER JOIN competencias c ON ra.id_competencia = c.id_competencia 
                          INNER JOIN usuarios u ON a.id_usuario_aprendiz = u.id_usuario 
                          INNER JOIN usuarios inst ON pa.id_usuario = inst.id_usuario 
                          ORDER BY a.fecha_asistencia DESC, f.numero_ficha, u.nombre");
        return $this->db->resultSet();
    }

    /**
     * Guardar (insertar o actualizar) un registro de asistencia
     * @param int $id_programacion
     * @param int $id_usuario_aprendiz
     * @param string $fecha_asistencia
     * @param int $asistio (1 o 0)
     * @param string $observacion
     * @return bool
     */
    public function guardar($id_programacion, $id_usuario_aprendiz, $fecha_asistencia, $asistio, $observacion) {
        $sql = "INSERT INTO asistencia (id_programacion, id_usuario_aprendiz, fecha_asistencia, asistio, observacion) 
                VALUES (:id_programacion, :id_aprendiz, :fecha, :asistio, :observacion)
                ON DUPLICATE KEY UPDATE 
                asistio = VALUES(asistio), 
                observacion = VALUES(observacion)";
                
        $this->db->query($sql);
        $this->db->bind(':id_programacion', $id_programacion);
        $this->db->bind(':id_aprendiz', $id_usuario_aprendiz);
        $this->db->bind(':fecha', $fecha_asistencia);
        $this->db->bind(':asistio', $asistio);
        $this->db->bind(':observacion', $observacion);
        
        return $this->db->execute();
    }

    /**
     * Determina si una planilla ya fue registrada para una programación y fecha.
     */
    public function existePlanillaParaFecha($id_programacion, $fecha_asistencia) {
        $this->db->query("SELECT COUNT(*) as total
                          FROM asistencia
                          WHERE id_programacion = :id_programacion
                            AND fecha_asistencia = :fecha");
        $this->db->bind(':id_programacion', (int) $id_programacion);
        $this->db->bind(':fecha', $fecha_asistencia);
        $row = $this->db->single();
        return $row && (int) $row->total > 0;
    }

    /**
     * Cuenta las sesiones vistas para el mismo RAP dentro de una ficha.
     */
    public function contarSesionesRealizadasPorResultado($numero_ficha, $id_resultado_aprendizaje) {
        $this->db->query("SELECT COUNT(DISTINCT a.fecha_asistencia) as total
                          FROM asistencia a
                          INNER JOIN programacion_academica pa ON a.id_programacion = pa.id_programacion
                          WHERE pa.numero_ficha = :numero_ficha
                            AND pa.id_resultado_aprendizaje = :id_resultado");
        $this->db->bind(':numero_ficha', $numero_ficha);
        $this->db->bind(':id_resultado', (int) $id_resultado_aprendizaje);
        $row = $this->db->single();
        return $row ? (int) $row->total : 0;
    }
}

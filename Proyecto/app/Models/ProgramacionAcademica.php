<?php
/**
 * Modelo ProgramacionAcademica
 * Gestiona operaciones CRUD de la tabla `programacion_academica`
 * Modo: Programación manual, sesión por sesión.
 */
class ProgramacionAcademica {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    /**
     * Obtener toda la programación académica
     */
    public function all() {
        $this->db->query("SELECT pa.*, f.numero_ficha, u.nombre as instructor_nombre, u.apellido as instructor_apellido, 
                          a.nombre as ambiente_nombre, d.nombre_dia, ra.codigo as ra_codigo, ra.descripcion as ra_descripcion, 
                          c.nombre as competencia_nombre 
                          FROM programacion_academica pa 
                          INNER JOIN fichas f ON pa.numero_ficha = f.numero_ficha 
                          INNER JOIN usuarios u ON pa.id_usuario = u.id_usuario 
                          INNER JOIN ambientes a ON pa.id_numero_ambiente = a.id_numero_ambiente 
                          INNER JOIN dias d ON pa.id_dias = d.id_dias 
                          INNER JOIN resultado_aprendizaje ra ON pa.id_resultado_aprendizaje = ra.id_resultado 
                          INNER JOIN competencias c ON ra.id_competencia = c.id_competencia 
                          ORDER BY pa.fecha_inicio DESC, pa.hora_inicio");
        return $this->db->resultSet();
    }

    /**
     * Crear una nueva programación (Sesión individual)
     */
    public function create($data) {
        // 1. Validar presupuesto de sesiones asignadas
        $this->db->query("SELECT sesiones_asignadas FROM resultado_aprendizaje WHERE id_resultado = :id_resultado");
        $this->db->bind(':id_resultado', $data['id_resultado_aprendizaje']);
        $resultado = $this->db->single();
        
        if (!$resultado) throw new Exception("El resultado de aprendizaje no existe.");
        
        $limite_sesiones = (int)$resultado->sesiones_asignadas;
        
        // 2. Contar sesiones existentes
        $this->db->query("SELECT COUNT(*) as total_actual FROM programacion_academica WHERE id_resultado_aprendizaje = :id_resultado");
        $this->db->bind(':id_resultado', $data['id_resultado_aprendizaje']);
        $conteo = $this->db->single();
        $sesiones_actuales = (int)$conteo->total_actual;

        if ($sesiones_actuales >= $limite_sesiones) {
            throw new Exception("Se alcanzó el límite de sesiones permitidas para este resultado.");
        }

        // 3. INSERT ÚNICO (Día a día)
        $this->db->query("INSERT INTO programacion_academica (numero_ficha, id_usuario, id_numero_ambiente, id_dias, hora_inicio, hora_fin, id_resultado_aprendizaje, fecha_inicio) 
                          VALUES (:ficha, :usuario, :ambiente, :dia, :h_inicio, :h_fin, :id_ra, :fecha)");
        
        $this->db->bind(':ficha', $data['numero_ficha']);
        $this->db->bind(':usuario', $data['id_usuario']);
        $this->db->bind(':ambiente', $data['id_numero_ambiente']);
        $this->db->bind(':dia', $data['id_dias']);
        $this->db->bind(':h_inicio', $data['hora_inicio']);
        $this->db->bind(':h_fin', $data['hora_fin']);
        $this->db->bind(':id_ra', $data['id_resultado_aprendizaje']);
        $this->db->bind(':fecha', $data['fecha_inicio']);
        
        return $this->db->execute();
    }

    /**
     * Obtener detalle directo para una fecha (Sin proyecciones)
     */
    public function getByFechaDetalle($fecha) {
        $this->db->query("SELECT pa.*, f.numero_ficha, j.nombre as jornada_nombre, u.nombre as instructor_nombre, 
                          u.apellido as instructor_apellido, a.nombre as ambiente_nombre, d.nombre_dia, 
                          ra.codigo as ra_codigo, c.nombre as competencia_nombre 
                          FROM programacion_academica pa 
                          INNER JOIN fichas f ON pa.numero_ficha = f.numero_ficha 
                          INNER JOIN jornada j ON f.id_jornada = j.id_jornada
                          INNER JOIN usuarios u ON pa.id_usuario = u.id_usuario 
                          INNER JOIN ambientes a ON pa.id_numero_ambiente = a.id_numero_ambiente 
                          INNER JOIN dias d ON pa.id_dias = d.id_dias 
                          INNER JOIN resultado_aprendizaje ra ON pa.id_resultado_aprendizaje = ra.id_resultado 
                          INNER JOIN competencias c ON ra.id_competencia = c.id_competencia 
                          WHERE pa.fecha_inicio = :fecha
                          ORDER BY pa.hora_inicio");
        
        $this->db->bind(':fecha', $fecha);
        return $this->db->resultSet();
    }

    /**
     * Valida conflictos en una fecha específica
     */
    public function getConflictMessage($data) {
        $this->db->query("SELECT * FROM programacion_academica WHERE fecha_inicio = :fecha");
        $this->db->bind(':fecha', $data['fecha_inicio']);
        $existing = $this->db->resultSet();

        foreach ($existing as $e) {
            // Verificar solapamiento de horas
            if (($data['hora_inicio'] < $e->hora_fin) && ($data['hora_fin'] > $e->hora_inicio)) {
                if ((int)$e->id_usuario === (int)$data['id_usuario']) return "Instructor ocupado en esta fecha.";
                if ((int)$e->id_numero_ambiente === (int)$data['id_numero_ambiente']) return "Ambiente ocupado en esta fecha.";
                if ((int)$e->numero_ficha === (int)$data['numero_ficha']) return "La ficha tiene otra sesión en esta fecha.";
            }
        }
        return null;
    }

    // Métodos estándar (Find, Update, Delete, otros getBy...)
    public function find($id) {
        $this->db->query("SELECT pa.*, f.numero_ficha, j.nombre as jornada_nombre, 
                          u.nombre as instructor_nombre, u.apellido as instructor_apellido, 
                          a.nombre as ambiente_nombre, d.nombre_dia, ra.codigo as ra_codigo, 
                          ra.descripcion as ra_descripcion, c.nombre as competencia_nombre 
                          FROM programacion_academica pa 
                          INNER JOIN fichas f ON pa.numero_ficha = f.numero_ficha 
                          INNER JOIN jornada j ON f.id_jornada = j.id_jornada
                          INNER JOIN usuarios u ON pa.id_usuario = u.id_usuario 
                          INNER JOIN ambientes a ON pa.id_numero_ambiente = a.id_numero_ambiente 
                          INNER JOIN dias d ON pa.id_dias = d.id_dias 
                          INNER JOIN resultado_aprendizaje ra ON pa.id_resultado_aprendizaje = ra.id_resultado 
                          INNER JOIN competencias c ON ra.id_competencia = c.id_competencia 
                          WHERE pa.id_programacion = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function update($id, $data) {
        $this->db->query("UPDATE programacion_academica SET numero_ficha = :ficha, id_usuario = :usuario, id_numero_ambiente = :ambiente, 
                          id_dias = :dia, hora_inicio = :h_inicio, hora_fin = :h_fin, id_resultado_aprendizaje = :id_ra, 
                          fecha_inicio = :fecha WHERE id_programacion = :id");
        $this->db->bind(':ficha', $data['numero_ficha']);
        $this->db->bind(':usuario', $data['id_usuario']);
        $this->db->bind(':ambiente', $data['id_numero_ambiente']);
        $this->db->bind(':dia', $data['id_dias']);
        $this->db->bind(':h_inicio', $data['hora_inicio']);
        $this->db->bind(':h_fin', $data['hora_fin']);
        $this->db->bind(':id_ra', $data['id_resultado_aprendizaje']);
        $this->db->bind(':fecha', $data['fecha_inicio']);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query("DELETE FROM programacion_academica WHERE id_programacion = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
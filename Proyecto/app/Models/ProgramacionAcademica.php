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
        $this->db->query("SELECT pa.id_programacion, pa.numero_ficha, pa.id_usuario, pa.id_numero_ambiente, pa.id_dias, pa.hora_inicio, pa.hora_fin, pa.id_resultado_aprendizaje, pa.fecha_inicio, 
                          f.numero_ficha, u.nombre as instructor_nombre, u.apellido as instructor_apellido, 
                          a.nombre as ambiente_nombre, d.nombre_dia, ra.codigo as ra_codigo, ra.descripcion as ra_descripcion, 
                          c.nombre as competencia_nombre,
                          COALESCE(frc.sesiones_asignadas_ajustadas, ra.sesiones_asignadas) as total_sesiones,
                          (COALESCE(frc.sesiones_asignadas_ajustadas, ra.sesiones_asignadas) * 6) as total_horas,
                          (SELECT COUNT(DISTINCT asi.fecha_asistencia) 
                           FROM asistencia asi 
                           INNER JOIN programacion_academica pa2 ON asi.id_programacion = pa2.id_programacion 
                           WHERE pa2.numero_ficha = pa.numero_ficha 
                             AND pa2.id_resultado_aprendizaje = pa.id_resultado_aprendizaje) as sesiones_realizadas,
                          ((SELECT COUNT(DISTINCT asi.fecha_asistencia) 
                           FROM asistencia asi 
                           INNER JOIN programacion_academica pa2 ON asi.id_programacion = pa2.id_programacion 
                           WHERE pa2.numero_ficha = pa.numero_ficha 
                             AND pa2.id_resultado_aprendizaje = pa.id_resultado_aprendizaje) * 6) as horas_realizadas
                          FROM programacion_academica pa 
                          INNER JOIN fichas f ON pa.numero_ficha = f.numero_ficha 
                          INNER JOIN usuarios u ON pa.id_usuario = u.id_usuario 
                          INNER JOIN ambientes a ON pa.id_numero_ambiente = a.id_numero_ambiente 
                          INNER JOIN dias d ON pa.id_dias = d.id_dias 
                          INNER JOIN resultado_aprendizaje ra ON pa.id_resultado_aprendizaje = ra.id_resultado 
                          INNER JOIN competencias c ON ra.id_competencia = c.id_competencia 
                          LEFT JOIN ficha_resultado_config frc ON ra.id_resultado = frc.id_resultado AND f.numero_ficha = frc.numero_ficha
                          ORDER BY pa.fecha_inicio DESC, pa.hora_inicio");
        return $this->db->resultSet();
    }

    /**
     * Crear una nueva programación (Sesión individual)
     */
    public function create($data) {
        // 1. Obtener presupuesto dinámico (El 'Stop Programático')
        // Usamos COALESCE para priorizar la configuración de la ficha sobre el valor base del RAP.
        // Además, extraemos el id_config por si existe la relación personalizada.
        $this->db->query("SELECT 
                            COALESCE(frc.sesiones_asignadas_ajustadas, ra.sesiones_asignadas) as limite_sesiones,
                            frc.id_config
                          FROM resultado_aprendizaje ra
                          LEFT JOIN ficha_resultado_config frc 
                            ON ra.id_resultado = frc.id_resultado AND frc.numero_ficha = :ficha
                          WHERE ra.id_resultado = :id_resultado");
                          
        $this->db->bind(':ficha', $data['numero_ficha']);
        $this->db->bind(':id_resultado', $data['id_resultado_aprendizaje']);
        $resultado = $this->db->single();
        
        if (!$resultado) throw new Exception("El resultado de aprendizaje no existe en la base de datos.");
        
        $limite_sesiones = (int)$resultado->limite_sesiones;
        $id_config_obtenido = $resultado->id_config ? $resultado->id_config : null;
        
        // 2. Contar sesiones existentes para ESTA FICHA y ESTE RESULTADO
        $this->db->query("SELECT COUNT(*) as total_actual 
                          FROM programacion_academica 
                          WHERE numero_ficha = :ficha AND id_resultado_aprendizaje = :id_resultado");
        $this->db->bind(':ficha', $data['numero_ficha']);
        $this->db->bind(':id_resultado', $data['id_resultado_aprendizaje']);
        $conteo = $this->db->single();
        $sesiones_actuales = (int)$conteo->total_actual;

        if ($sesiones_actuales >= $limite_sesiones) {
            throw new Exception("Se alcanzó el límite de sesiones permitidas ({$limite_sesiones}) para este resultado en esta ficha.");
        }

        // 3. INSERT ÚNICO (Día a día) con el id_config (si aplica)
        $this->db->query("INSERT INTO programacion_academica 
                          (numero_ficha, id_usuario, id_numero_ambiente, id_dias, hora_inicio, hora_fin, id_resultado_aprendizaje, fecha_inicio, id_config) 
                          VALUES (:ficha, :usuario, :ambiente, :dia, :h_inicio, :h_fin, :id_ra, :fecha, :id_config)");
        
        $this->db->bind(':ficha', $data['numero_ficha']);
        $this->db->bind(':usuario', $data['id_usuario']);
        $this->db->bind(':ambiente', $data['id_numero_ambiente']);
        $this->db->bind(':dia', $data['id_dias']);
        $this->db->bind(':h_inicio', $data['hora_inicio']);
        $this->db->bind(':h_fin', $data['hora_fin']);
        $this->db->bind(':id_ra', $data['id_resultado_aprendizaje']);
        $this->db->bind(':fecha', $data['fecha_inicio']);
        $this->db->bind(':id_config', $id_config_obtenido);
        
        return $this->db->execute();
    }

    /**
     * Obtener detalle directo para una fecha (Sin proyecciones)
     */
    public function getByFechaDetalle($fecha) {
        $this->db->query("SELECT pa.id_programacion, pa.numero_ficha, pa.id_usuario, pa.id_numero_ambiente, pa.id_dias, pa.hora_inicio, pa.hora_fin, pa.id_resultado_aprendizaje, pa.fecha_inicio, 
                          f.numero_ficha, j.nombre as jornada_nombre, u.nombre as instructor_nombre, 
                          u.apellido as instructor_apellido, a.nombre as ambiente_nombre, d.nombre_dia, 
                          ra.codigo as ra_codigo, c.nombre as competencia_nombre,
                          COALESCE(frc.sesiones_asignadas_ajustadas, ra.sesiones_asignadas) as total_sesiones,
                          (COALESCE(frc.sesiones_asignadas_ajustadas, ra.sesiones_asignadas) * 6) as total_horas,
                          (SELECT COUNT(DISTINCT asi.fecha_asistencia) 
                           FROM asistencia asi 
                           INNER JOIN programacion_academica pa2 ON asi.id_programacion = pa2.id_programacion 
                           WHERE pa2.numero_ficha = pa.numero_ficha 
                             AND pa2.id_resultado_aprendizaje = pa.id_resultado_aprendizaje) as sesiones_realizadas,
                          ((SELECT COUNT(DISTINCT asi.fecha_asistencia) 
                           FROM asistencia asi 
                           INNER JOIN programacion_academica pa2 ON asi.id_programacion = pa2.id_programacion 
                           WHERE pa2.numero_ficha = pa.numero_ficha 
                             AND pa2.id_resultado_aprendizaje = pa.id_resultado_aprendizaje) * 6) as horas_realizadas
                          FROM programacion_academica pa 
                          INNER JOIN fichas f ON pa.numero_ficha = f.numero_ficha 
                          INNER JOIN jornada j ON f.id_jornada = j.id_jornada
                          INNER JOIN usuarios u ON pa.id_usuario = u.id_usuario 
                          INNER JOIN ambientes a ON pa.id_numero_ambiente = a.id_numero_ambiente 
                          INNER JOIN dias d ON pa.id_dias = d.id_dias 
                          INNER JOIN resultado_aprendizaje ra ON pa.id_resultado_aprendizaje = ra.id_resultado 
                          INNER JOIN competencias c ON ra.id_competencia = c.id_competencia 
                          LEFT JOIN ficha_resultado_config frc ON ra.id_resultado = frc.id_resultado AND f.numero_ficha = frc.numero_ficha
                          WHERE pa.fecha_inicio = :fecha
                          ORDER BY pa.hora_inicio");
        
        $this->db->bind(':fecha', $fecha);
        return $this->db->resultSet();
    }

    /**
     * Valida conflictos en una fecha específica
     */
    public function getConflictMessage($data) {
        // Obtener la programación existente para la fecha
        $this->db->query("SELECT * FROM programacion_academica WHERE fecha_inicio = :fecha");
        $this->db->bind(':fecha', $data['fecha_inicio']);
        $existing = $this->db->resultSet();

        // Buscar si hay liberaciones (excepciones) en la tabla novedad_ambiente para esta fecha
        $this->db->query("SELECT descripcion FROM novedad_ambiente WHERE fecha_reporte = :fecha AND descripcion LIKE '[LIBERADO_PROG:%'");
        $this->db->bind(':fecha', $data['fecha_inicio']);
        $novedades = $this->db->resultSet();
        
        $liberadosIds = [];
        foreach ($novedades as $nov) {
            if (preg_match('/\[LIBERADO_PROG:(\d+)\]/', $nov->descripcion, $matches)) {
                $liberadosIds[] = (int)$matches[1];
            }
        }

        foreach ($existing as $e) {
            // Si esta programación específica está liberada, la ignoramos para cruces de horarios
            if (in_array((int)$e->id_programacion, $liberadosIds)) {
                continue;
            }

            // Verificar solapamiento de horas
            if (($data['hora_inicio'] < $e->hora_fin) && ($data['hora_fin'] > $e->hora_inicio)) {
                if ((int)$e->id_usuario === (int)$data['id_usuario']) return "Instructor ocupado en esta fecha.";
                if ((int)$e->id_numero_ambiente === (int)$data['id_numero_ambiente']) return "Ambiente ocupado en esta fecha.";
                if ((int)$e->numero_ficha === (int)$data['numero_ficha']) return "La ficha tiene otra sesión en esta fecha.";
            }
        }
        return null;
    }

    public function getByInstructor($id_usuario) {
        $this->db->query("SELECT pa.id_programacion, pa.numero_ficha, pa.id_usuario, pa.id_numero_ambiente, pa.id_dias, pa.hora_inicio, pa.hora_fin, pa.id_resultado_aprendizaje, pa.fecha_inicio, 
                          f.numero_ficha, u.nombre as instructor_nombre, u.apellido as instructor_apellido, 
                          a.nombre as ambiente_nombre, d.nombre_dia, ra.codigo as ra_codigo, ra.descripcion as ra_descripcion, 
                          c.nombre as competencia_nombre,
                          COALESCE(frc.sesiones_asignadas_ajustadas, ra.sesiones_asignadas) as total_sesiones,
                          (COALESCE(frc.sesiones_asignadas_ajustadas, ra.sesiones_asignadas) * 6) as total_horas,
                          (SELECT COUNT(DISTINCT asi.fecha_asistencia) 
                           FROM asistencia asi 
                           INNER JOIN programacion_academica pa2 ON asi.id_programacion = pa2.id_programacion 
                           WHERE pa2.numero_ficha = pa.numero_ficha 
                             AND pa2.id_resultado_aprendizaje = pa.id_resultado_aprendizaje) as sesiones_realizadas,
                          ((SELECT COUNT(DISTINCT asi.fecha_asistencia) 
                           FROM asistencia asi 
                           INNER JOIN programacion_academica pa2 ON asi.id_programacion = pa2.id_programacion 
                           WHERE pa2.numero_ficha = pa.numero_ficha 
                             AND pa2.id_resultado_aprendizaje = pa.id_resultado_aprendizaje) * 6) as horas_realizadas
                          FROM programacion_academica pa 
                          INNER JOIN fichas f ON pa.numero_ficha = f.numero_ficha 
                          INNER JOIN usuarios u ON pa.id_usuario = u.id_usuario 
                          INNER JOIN ambientes a ON pa.id_numero_ambiente = a.id_numero_ambiente 
                          INNER JOIN dias d ON pa.id_dias = d.id_dias 
                          INNER JOIN resultado_aprendizaje ra ON pa.id_resultado_aprendizaje = ra.id_resultado 
                          INNER JOIN competencias c ON ra.id_competencia = c.id_competencia 
                          LEFT JOIN ficha_resultado_config frc ON ra.id_resultado = frc.id_resultado AND f.numero_ficha = frc.numero_ficha
                          WHERE pa.id_usuario = :id
                          ORDER BY pa.fecha_inicio DESC, pa.hora_inicio");
        $this->db->bind(':id', $id_usuario);
        return $this->db->resultSet();
    }

    public function getByAprendiz($id_usuario) {
        $this->db->query("SELECT pa.id_programacion, pa.numero_ficha, pa.id_usuario, pa.id_numero_ambiente, pa.id_dias, pa.hora_inicio, pa.hora_fin, pa.id_resultado_aprendizaje, pa.fecha_inicio, 
                          f.numero_ficha, u.nombre as instructor_nombre, u.apellido as instructor_apellido, 
                          a.nombre as ambiente_nombre, d.nombre_dia, ra.codigo as ra_codigo, ra.descripcion as ra_descripcion, 
                          c.nombre as competencia_nombre,
                          COALESCE(frc.sesiones_asignadas_ajustadas, ra.sesiones_asignadas) as total_sesiones,
                          (COALESCE(frc.sesiones_asignadas_ajustadas, ra.sesiones_asignadas) * 6) as total_horas,
                          (SELECT COUNT(DISTINCT asi.fecha_asistencia) 
                           FROM asistencia asi 
                           INNER JOIN programacion_academica pa2 ON asi.id_programacion = pa2.id_programacion 
                           WHERE pa2.numero_ficha = pa.numero_ficha 
                             AND pa2.id_resultado_aprendizaje = pa.id_resultado_aprendizaje) as sesiones_realizadas,
                          ((SELECT COUNT(DISTINCT asi.fecha_asistencia) 
                           FROM asistencia asi 
                           INNER JOIN programacion_academica pa2 ON asi.id_programacion = pa2.id_programacion 
                           WHERE pa2.numero_ficha = pa.numero_ficha 
                             AND pa2.id_resultado_aprendizaje = pa.id_resultado_aprendizaje) * 6) as horas_realizadas
                          FROM programacion_academica pa 
                          INNER JOIN fichas f ON pa.numero_ficha = f.numero_ficha 
                          INNER JOIN ficha_aprendiz fa ON fa.numero_ficha = f.numero_ficha
                          INNER JOIN usuarios u ON pa.id_usuario = u.id_usuario 
                          INNER JOIN ambientes a ON pa.id_numero_ambiente = a.id_numero_ambiente 
                          INNER JOIN dias d ON pa.id_dias = d.id_dias 
                          INNER JOIN resultado_aprendizaje ra ON pa.id_resultado_aprendizaje = ra.id_resultado 
                          INNER JOIN competencias c ON ra.id_competencia = c.id_competencia 
                          LEFT JOIN ficha_resultado_config frc ON ra.id_resultado = frc.id_resultado AND f.numero_ficha = frc.numero_ficha
                          WHERE fa.id_usuario_aprendiz = :id
                          ORDER BY pa.fecha_inicio DESC, pa.hora_inicio");
        $this->db->bind(':id', $id_usuario);
        return $this->db->resultSet();
    }

    public function getByFicha($numero_ficha) {
        $this->db->query("SELECT pa.id_programacion, pa.numero_ficha, pa.id_usuario, pa.id_numero_ambiente, pa.id_dias, pa.hora_inicio, pa.hora_fin, pa.id_resultado_aprendizaje, pa.fecha_inicio, 
                          f.numero_ficha, u.nombre as instructor_nombre, u.apellido as instructor_apellido, 
                          a.nombre as ambiente_nombre, d.nombre_dia, ra.codigo as ra_codigo, ra.descripcion as ra_descripcion, 
                          c.nombre as competencia_nombre,
                          COALESCE(frc.sesiones_asignadas_ajustadas, ra.sesiones_asignadas) as total_sesiones,
                          (COALESCE(frc.sesiones_asignadas_ajustadas, ra.sesiones_asignadas) * 6) as total_horas,
                          (SELECT COUNT(DISTINCT asi.fecha_asistencia) 
                           FROM asistencia asi 
                           INNER JOIN programacion_academica pa2 ON asi.id_programacion = pa2.id_programacion 
                           WHERE pa2.numero_ficha = pa.numero_ficha 
                             AND pa2.id_resultado_aprendizaje = pa.id_resultado_aprendizaje) as sesiones_realizadas,
                          ((SELECT COUNT(DISTINCT asi.fecha_asistencia) 
                           FROM asistencia asi 
                           INNER JOIN programacion_academica pa2 ON asi.id_programacion = pa2.id_programacion 
                           WHERE pa2.numero_ficha = pa.numero_ficha 
                             AND pa2.id_resultado_aprendizaje = pa.id_resultado_aprendizaje) * 6) as horas_realizadas
                          FROM programacion_academica pa 
                          INNER JOIN fichas f ON pa.numero_ficha = f.numero_ficha 
                          INNER JOIN usuarios u ON pa.id_usuario = u.id_usuario 
                          INNER JOIN ambientes a ON pa.id_numero_ambiente = a.id_numero_ambiente 
                          INNER JOIN dias d ON pa.id_dias = d.id_dias 
                          INNER JOIN resultado_aprendizaje ra ON pa.id_resultado_aprendizaje = ra.id_resultado 
                          INNER JOIN competencias c ON ra.id_competencia = c.id_competencia 
                          LEFT JOIN ficha_resultado_config frc ON ra.id_resultado = frc.id_resultado AND f.numero_ficha = frc.numero_ficha
                          WHERE pa.numero_ficha = :ficha
                          ORDER BY pa.fecha_inicio DESC, pa.hora_inicio");
        $this->db->bind(':ficha', $numero_ficha);
        return $this->db->resultSet();
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

    public function getByAmbiente($id_ambiente) {
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
                          WHERE pa.id_numero_ambiente = :id
                          ORDER BY pa.fecha_inicio DESC, pa.hora_inicio");
        $this->db->bind(':id', $id_ambiente);
        return $this->db->resultSet();
    }
}
<?php
/**
 * Modelo ProgramacionAcademica
 * Gestiona las operaciones CRUD y joins complejos de la tabla `programacion_academica`.
 */
class ProgramacionAcademica {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    /**
     * Obtener toda la programación académica con joins completos
     * @return array
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
     * Obtener programación asignada a un instructor
     * @param int $id_instructor
     * @return array
     */
    public function getByInstructor($id_instructor) {
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
                          WHERE pa.id_usuario = :id_instructor 
                          ORDER BY pa.fecha_inicio DESC, pa.hora_inicio");
        $this->db->bind(':id_instructor', $id_instructor);
        return $this->db->resultSet();
    }

    /**
     * Obtener programación de una ficha (útil para aprendices)
     * @param int $numero_ficha
     * @return array
     */
    public function getByFicha($numero_ficha) {
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
                          WHERE pa.numero_ficha = :numero_ficha 
                          ORDER BY pa.fecha_inicio DESC, pa.hora_inicio");
        $this->db->bind(':numero_ficha', $numero_ficha);
        return $this->db->resultSet();
    }

    /**
     * Obtener programación de un aprendiz (mediante las fichas en las que está inscrito)
     * @param int $id_aprendiz
     * @return array
     */
    public function getByAprendiz($id_aprendiz) {
        $this->db->query("SELECT pa.*, f.numero_ficha, u.nombre as instructor_nombre, u.apellido as instructor_apellido, 
                          a.nombre as ambiente_nombre, d.nombre_dia, ra.codigo as ra_codigo, ra.descripcion as ra_descripcion, 
                          c.nombre as competencia_nombre 
                          FROM programacion_academica pa 
                          INNER JOIN fichas f ON pa.numero_ficha = f.numero_ficha 
                          INNER JOIN ficha_aprendiz fa ON f.numero_ficha = fa.numero_ficha 
                          INNER JOIN usuarios u ON pa.id_usuario = u.id_usuario 
                          INNER JOIN ambientes a ON pa.id_numero_ambiente = a.id_numero_ambiente 
                          INNER JOIN dias d ON pa.id_dias = d.id_dias 
                          INNER JOIN resultado_aprendizaje ra ON pa.id_resultado_aprendizaje = ra.id_resultado 
                          INNER JOIN competencias c ON ra.id_competencia = c.id_competencia 
                          WHERE fa.id_usuario_aprendiz = :id_aprendiz 
                          ORDER BY pa.fecha_inicio DESC, pa.hora_inicio");
        $this->db->bind(':id_aprendiz', $id_aprendiz);
        return $this->db->resultSet();
    }

    /**
     * Obtener el detalle de una programación por su ID
     * @param int $id
     * @return object|false
     */
    public function find($id) {
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
                          WHERE pa.id_programacion = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    /**
     * Crear una nueva programación académica
     * @param array $data
     * @return bool
     */
    public function create($data) {
        $this->db->query("INSERT INTO programacion_academica (numero_ficha, id_usuario, id_numero_ambiente, id_dias, hora_inicio, hora_fin, id_resultado_aprendizaje, fecha_inicio) 
                          VALUES (:numero_ficha, :id_usuario, :id_numero_ambiente, :id_dias, :hora_inicio, :hora_fin, :id_resultado_aprendizaje, :fecha_inicio)");
        $this->db->bind(':numero_ficha', $data['numero_ficha']);
        $this->db->bind(':id_usuario', $data['id_usuario']);
        $this->db->bind(':id_numero_ambiente', $data['id_numero_ambiente']);
        $this->db->bind(':id_dias', $data['id_dias']);
        $this->db->bind(':hora_inicio', $data['hora_inicio']);
        $this->db->bind(':hora_fin', $data['hora_fin']);
        $this->db->bind(':id_resultado_aprendizaje', $data['id_resultado_aprendizaje']);
        $this->db->bind(':fecha_inicio', $data['fecha_inicio']);
        return $this->db->execute();
    }

    /**
     * Actualizar una programación académica
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, $data) {
        $this->db->query("UPDATE programacion_academica SET numero_ficha = :numero_ficha, id_usuario = :id_usuario, 
                          id_numero_ambiente = :id_numero_ambiente, id_dias = :id_dias, hora_inicio = :hora_inicio, 
                          hora_fin = :hora_fin, id_resultado_aprendizaje = :id_resultado_aprendizaje, fecha_inicio = :fecha_inicio 
                          WHERE id_programacion = :id");
        $this->db->bind(':numero_ficha', $data['numero_ficha']);
        $this->db->bind(':id_usuario', $data['id_usuario']);
        $this->db->bind(':id_numero_ambiente', $data['id_numero_ambiente']);
        $this->db->bind(':id_dias', $data['id_dias']);
        $this->db->bind(':hora_inicio', $data['hora_inicio']);
        $this->db->bind(':hora_fin', $data['hora_fin']);
        $this->db->bind(':id_resultado_aprendizaje', $data['id_resultado_aprendizaje']);
        $this->db->bind(':fecha_inicio', $data['fecha_inicio']);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    /**
     * Eliminar una programación académica
     * @param int $id
     * @return bool
     */
    public function delete($id) {
        $this->db->query("DELETE FROM programacion_academica WHERE id_programacion = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    /**
     * Obtener programación para una fecha específica con JOINs completos para el detalle diario
     * @param string $fecha YYYY-MM-DD
     * @return array
     */
    public function getByFechaDetalle($fecha) {
        $this->db->query("SELECT pa.*, f.numero_ficha, j.nombre as jornada_nombre, j.id_jornada,
                          u.nombre as instructor_nombre, u.apellido as instructor_apellido, 
                          a.nombre as ambiente_nombre, d.nombre_dia, ra.codigo as ra_codigo, ra.descripcion as ra_descripcion, 
                          c.nombre as competencia_nombre 
                          FROM programacion_academica pa 
                          INNER JOIN fichas f ON pa.numero_ficha = f.numero_ficha 
                          INNER JOIN jornada j ON f.id_jornada = j.id_jornada
                          INNER JOIN usuarios u ON pa.id_usuario = u.id_usuario 
                          INNER JOIN ambientes a ON pa.id_numero_ambiente = a.id_numero_ambiente 
                          INNER JOIN dias d ON pa.id_dias = d.id_dias 
                          INNER JOIN resultado_aprendizaje ra ON pa.id_resultado_aprendizaje = ra.id_resultado 
                          INNER JOIN competencias c ON ra.id_competencia = c.id_competencia 
                          ORDER BY j.id_jornada, pa.hora_inicio");
        $todas = $this->db->resultSet();
        
        $filtradas = [];
        $timestampTarget = strtotime($fecha);
        $dayOfWeekTarget = date('N', $timestampTarget); // 1 (Lunes) a 7 (Domingo)
        
        foreach ($todas as $p) {
            if ((int)$p->id_dias !== (int)$dayOfWeekTarget) {
                continue;
            }
            
            $timestampInicio = strtotime($p->fecha_inicio);
            if ($timestampTarget < $timestampInicio) {
                continue;
            }
            
            $diffDays = round(($timestampTarget - $timestampInicio) / (60 * 60 * 24));
            $weeksElapsed = floor($diffDays / 7);
            
            if ($weeksElapsed < (int)$p->total_sesiones) {
                $filtradas[] = $p;
            }
        }
        
        return $filtradas;
    }

    /**
     * Valida conflictos antes de registrar o modificar una programación
     * @param array $data
     * @return string|null Mensaje del conflicto o null si no hay conflicto
     */
    public function getConflictMessage($data) {
        // 1. Obtener sesiones asignadas para calcular total_sesiones y fecha fin
        $this->db->query("SELECT sesiones_asignadas FROM resultado_aprendizaje WHERE id_resultado = :id_resultado");
        $this->db->bind(':id_resultado', $data['id_resultado_aprendizaje']);
        $res = $this->db->single();
        if (!$res || (int)$res->sesiones_asignadas <= 0) {
            return "El resultado de aprendizaje no tiene sesiones asignadas válidas.";
        }
        $new_total_sesiones = (int)$res->sesiones_asignadas;

        // Calcular primera y última sesión de la nueva programación
        $first_session_N = $this->getFirstSessionDate($data['fecha_inicio'], $data['id_dias']);
        $last_session_N = date('Y-m-d', strtotime("+" . (($new_total_sesiones - 1) * 7) . " days", strtotime($first_session_N)));

        // 2. Consultar registros existentes en el mismo día
        $this->db->query("SELECT * FROM programacion_academica WHERE id_dias = :id_dias");
        $this->db->bind(':id_dias', $data['id_dias']);
        $existing = $this->db->resultSet();

        foreach ($existing as $e) {
            // Verificar solapamiento de horas
            if (($data['hora_inicio'] < $e->hora_fin) && ($data['hora_fin'] > $e->hora_inicio)) {
                // Verificar solapamiento de fechas
                $first_session_E = $this->getFirstSessionDate($e->fecha_inicio, $e->id_dias);
                $last_session_E = date('Y-m-d', strtotime("+" . (($e->total_sesiones - 1) * 7) . " days", strtotime($first_session_E)));

                if (($first_session_N <= $last_session_E) && ($first_session_E <= $last_session_N)) {
                    // Hay solapamiento de día, hora y fecha. Verificar tipo de conflicto:
                    if ((int)$e->id_usuario === (int)$data['id_usuario']) {
                        return "El instructor ya tiene una programación en ese horario.";
                    }
                    if ((int)$e->id_numero_ambiente === (int)$data['id_numero_ambiente']) {
                        return "El ambiente ya se encuentra ocupado.";
                    }
                    if ((int)$e->numero_ficha === (int)$data['numero_ficha']) {
                        return "La ficha / grupo ya tiene una programación asignada para ese horario.";
                    }
                }
            }
        }
        return null;
    }

    private function getFirstSessionDate($fecha_inicio, $id_dias) {
        $timestamp = strtotime($fecha_inicio);
        $dayOfWeek = date('N', $timestamp); // 1 = Lunes, ..., 7 = Domingo
        $diff = $id_dias - $dayOfWeek;
        if ($diff < 0) {
            $diff += 7;
        }
        return date('Y-m-d', strtotime("+$diff days", $timestamp));
    }
}

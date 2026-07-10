<?php
/**
 * Modelo FichaResultadoConfig
 * Gestiona el Ajuste Inteligente de Competencias (Stop Programático)
 */
class FichaResultadoConfig {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    /**
     * 1. Cálculo Automático
     * Toma el % y las horas base y calcula el nuevo presupuesto.
     */
    public function calcularAjuste($horas_base, $porcentaje_ajustado, $horas_por_sesion = 6) {
        $horas_a_ejecutar_ajustadas = $horas_base * ($porcentaje_ajustado / 100);
        $sesiones_asignadas_ajustadas = ceil($horas_a_ejecutar_ajustadas / $horas_por_sesion);

        return [
            'horas_a_ejecutar_ajustadas' => $horas_a_ejecutar_ajustadas,
            'sesiones_asignadas_ajustadas' => $sesiones_asignadas_ajustadas
        ];
    }

    /**
     * 2 y 3. Validación de Integridad (El Stop) y Persistencia Segura
     */
    public function guardarConfiguracion($numero_ficha, $id_resultado, $porcentaje_ajustado, $horas_base, $horas_por_sesion = 6) {
        
        $calculo = $this->calcularAjuste($horas_base, $porcentaje_ajustado, $horas_por_sesion);
        $nuevas_sesiones = $calculo['sesiones_asignadas_ajustadas'];
        $nuevas_horas = $calculo['horas_a_ejecutar_ajustadas'];

        // Buscar si ya existe la configuración
        $this->db->query("SELECT id_config FROM ficha_resultado_config WHERE numero_ficha = :ficha AND id_resultado = :id_resultado");
        $this->db->bind(':ficha', $numero_ficha);
        $this->db->bind(':id_resultado', $id_resultado);
        $configExistente = $this->db->single();

        $sesiones_ya_programadas = 0;

        if ($configExistente) {
            $this->db->query("SELECT COUNT(*) as total FROM programacion_academica WHERE id_config = :id_config");
            $this->db->bind(':id_config', $configExistente->id_config);
            $conteo = $this->db->single();
            $sesiones_ya_programadas = (int)$conteo->total;
        } else {
            $this->db->query("SELECT COUNT(*) as total FROM programacion_academica WHERE numero_ficha = :ficha AND id_resultado_aprendizaje = :id_resultado");
            $this->db->bind(':ficha', $numero_ficha);
            $this->db->bind(':id_resultado', $id_resultado);
            $conteo = $this->db->single();
            $sesiones_ya_programadas = (int)$conteo->total;
        }

        // Regla de bloqueo: El "Stop"
        if ($nuevas_sesiones < $sesiones_ya_programadas) {
            throw new Exception("Conflicto de Integridad: No puedes reducir el alcance al {$porcentaje_ajustado}%. Esto limitaría el RAP a {$nuevas_sesiones} sesiones, pero la ficha ya tiene {$sesiones_ya_programadas} sesiones programadas.");
        }

        // Persistencia
        $sql = "INSERT INTO ficha_resultado_config 
                (numero_ficha, id_resultado, porcentaje_ajustado, horas_a_ejecutar_ajustadas, sesiones_asignadas_ajustadas) 
                VALUES (:ficha, :id_resultado, :porcentaje, :horas, :sesiones)
                ON DUPLICATE KEY UPDATE 
                porcentaje_ajustado = VALUES(porcentaje_ajustado),
                horas_a_ejecutar_ajustadas = VALUES(horas_a_ejecutar_ajustadas),
                sesiones_asignadas_ajustadas = VALUES(sesiones_asignadas_ajustadas)";

        $this->db->query($sql);
        $this->db->bind(':ficha', $numero_ficha);
        $this->db->bind(':id_resultado', $id_resultado);
        $this->db->bind(':porcentaje', $porcentaje_ajustado);
        $this->db->bind(':horas', $nuevas_horas);
        $this->db->bind(':sesiones', $nuevas_sesiones);

        return $this->db->execute();
    }
}

<?php
/**
 * Modelo Ambiente
 * Gestiona las operaciones CRUD de la tabla `ambientes`.
 */
class Ambiente {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    /**
     * Obtener todos los ambientes
     * @return array
     */
    public function all() {
        $this->db->query("SELECT * FROM ambientes ORDER BY nombre");
        return $this->db->resultSet();
    }

    /**
     * Obtener un ambiente por ID
     * @param int $id
     * @return object|false
     */
    public function find($id) {
        $this->db->query("SELECT * FROM ambientes WHERE id_numero_ambiente = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    /**
     * Obtener ambientes disponibles
     * @return array
     */
    public function disponibles() {
        $this->db->query("SELECT * FROM ambientes WHERE disponibilidad = 1 ORDER BY nombre");
        return $this->db->resultSet();
    }

    /**
     * Crear un nuevo ambiente
     * @param array $data
     * @return bool
     */
    public function create($data) {
        $this->db->query("INSERT INTO ambientes (nombre, tipo, capacidad, aire, ventilador, tablero, tv, computadores, especialidad_ambiente, disponibilidad) 
                          VALUES (:nombre, :tipo, :capacidad, :aire, :ventilador, :tablero, :tv, :computadores, :especialidad_ambiente, :disponibilidad)");
        $this->db->bind(':nombre', $data['nombre']);
        $this->db->bind(':tipo', $data['tipo']);
        $this->db->bind(':capacidad', $data['capacidad']);
        $this->db->bind(':aire', !empty($data['aire']) ? 1 : 0);
        $this->db->bind(':ventilador', !empty($data['ventilador']) ? 1 : 0);
        $this->db->bind(':tablero', !empty($data['tablero']) ? 1 : 0);
        $this->db->bind(':tv', !empty($data['tv']) ? 1 : 0);
        $this->db->bind(':computadores', $data['computadores']);
        $this->db->bind(':especialidad_ambiente', $data['especialidad_ambiente']);
        $this->db->bind(':disponibilidad', !empty($data['disponibilidad']) ? 1 : 0);
        return $this->db->execute();
    }

    /**
     * Actualizar un ambiente existente
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, $data) {
        $this->db->query("UPDATE ambientes SET nombre = :nombre, tipo = :tipo, capacidad = :capacidad, 
                          aire = :aire, ventilador = :ventilador, tablero = :tablero, tv = :tv, 
                          computadores = :computadores, especialidad_ambiente = :especialidad_ambiente, 
                          disponibilidad = :disponibilidad WHERE id_numero_ambiente = :id");
        $this->db->bind(':nombre', $data['nombre']);
        $this->db->bind(':tipo', $data['tipo']);
        $this->db->bind(':capacidad', $data['capacidad']);
        $this->db->bind(':aire', !empty($data['aire']) ? 1 : 0);
        $this->db->bind(':ventilador', !empty($data['ventilador']) ? 1 : 0);
        $this->db->bind(':tablero', !empty($data['tablero']) ? 1 : 0);
        $this->db->bind(':tv', !empty($data['tv']) ? 1 : 0);
        $this->db->bind(':computadores', $data['computadores']);
        $this->db->bind(':especialidad_ambiente', $data['especialidad_ambiente']);
        $this->db->bind(':disponibilidad', !empty($data['disponibilidad']) ? 1 : 0);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    /**
     * Eliminar un ambiente
     * @param int $id
     * @return bool
     */
    public function delete($id) {
        $this->db->query("DELETE FROM ambientes WHERE id_numero_ambiente = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    /**
     * Verifica si existe un ambiente con nombre similar (ignorando espacios y mayúsculas)
     * @param string $nombre
     * @param int|null $excludeId ID a excluir (para cuando se actualiza)
     * @return bool
     */
    public function existeNombreSimilar($nombre, $excludeId = null) {
        // Normalizamos el nombre: minúsculas y sin espacios
        $nombreNormalizado = strtolower(str_replace(' ', '', $nombre));
        
        $sql = "SELECT id_numero_ambiente FROM ambientes WHERE REPLACE(LOWER(nombre), ' ', '') = :nombreNormalizado";
        if ($excludeId !== null) {
            $sql .= " AND id_numero_ambiente != :excludeId";
        }
        
        $this->db->query($sql);
        $this->db->bind(':nombreNormalizado', $nombreNormalizado);
        if ($excludeId !== null) {
            $this->db->bind(':excludeId', $excludeId);
        }
        
        $resultado = $this->db->single();
        return $resultado ? true : false;
    }
}

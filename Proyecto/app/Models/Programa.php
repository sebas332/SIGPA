<?php
/**
 * Modelo Programa
 * Gestiona las operaciones CRUD de la tabla `programa`.
 */
class Programa {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    /**
     * Obtener todos los programas junto con su tipo
     * @return array
     */
    public function all() {
        $this->db->query("SELECT p.*, tp.nombre as tipo_nombre FROM programa p 
                          INNER JOIN tipo_programa tp ON p.id_tipo_programa = tp.id_tipo_programa 
                          ORDER BY p.nombre");
        return $this->db->resultSet();
    }

    /**
     * Obtener un programa por ID
     * @param int $id
     * @return object|false
     */
    public function find($id) {
        $this->db->query("SELECT p.*, tp.nombre as tipo_nombre FROM programa p 
                          INNER JOIN tipo_programa tp ON p.id_tipo_programa = tp.id_tipo_programa 
                          WHERE p.id_programa = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    /**
     * Crear un nuevo programa
     * @param array $data
     * @return bool
     */
    public function create($data) {
        $this->db->query("INSERT INTO programa (nombre, codigo, version, vigencia, duracion_lectiva, duracion_practica, id_tipo_programa) 
                          VALUES (:nombre, :codigo, :version, :vigencia, :duracion_lectiva, :duracion_practica, :id_tipo_programa)");
        $this->db->bind(':nombre', $data['nombre']);
        $this->db->bind(':codigo', $data['codigo']);
        $this->db->bind(':version', $data['version']);
        $this->db->bind(':vigencia', $data['vigencia']);
        $this->db->bind(':duracion_lectiva', $data['duracion_lectiva']);
        $this->db->bind(':duracion_practica', $data['duracion_practica']);
        $this->db->bind(':id_tipo_programa', $data['id_tipo_programa']);
        return $this->db->execute();
    }

    /**
     * Actualizar un programa
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, $data) {
        $this->db->query("UPDATE programa SET nombre = :nombre, codigo = :codigo, version = :version, 
                          vigencia = :vigencia, duracion_lectiva = :duracion_lectiva, 
                          duracion_practica = :duracion_practica, id_tipo_programa = :id_tipo_programa 
                          WHERE id_programa = :id");
        $this->db->bind(':nombre', $data['nombre']);
        $this->db->bind(':codigo', $data['codigo']);
        $this->db->bind(':version', $data['version']);
        $this->db->bind(':vigencia', $data['vigencia']);
        $this->db->bind(':duracion_lectiva', $data['duracion_lectiva']);
        $this->db->bind(':duracion_practica', $data['duracion_practica']);
        $this->db->bind(':id_tipo_programa', $data['id_tipo_programa']);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    /**
     * Eliminar un programa
     * @param int $id
     * @return bool
     */
    public function delete($id) {
        try {
            $this->db->beginTransaction();

            // 1. Obtener competencias asociadas
            $this->db->query("SELECT id_competencia FROM competencias WHERE id_programa = :id");
            $this->db->bind(':id', $id);
            $competencias = $this->db->resultSet();

            // 2. Eliminar resultados de aprendizaje de las competencias del programa
            foreach ($competencias as $comp) {
                $this->db->query("DELETE FROM resultado_aprendizaje WHERE id_competencia = :id_comp");
                $this->db->bind(':id_comp', $comp->id_competencia);
                $this->db->execute();
            }

            // 3. Eliminar competencias del programa
            $this->db->query("DELETE FROM competencias WHERE id_programa = :id");
            $this->db->bind(':id', $id);
            $this->db->execute();

            // 4. Eliminar el programa de formación
            $this->db->query("DELETE FROM programa WHERE id_programa = :id");
            $this->db->bind(':id', $id);
            $result = $this->db->execute();

            $this->db->commit();
            return $result;
        } catch (PDOException $e) {
            if ($this->db->getConnection()->inTransaction()) {
                $this->db->rollBack();
            }
            throw $e;
        }
    }

    /**
     * Obtener el último ID de programa insertado
     * @return int
     */
    public function getLastInsertId() {
        return $this->db->lastInsertId();
    }
}

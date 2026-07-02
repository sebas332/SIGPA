<?php
/**
 * Clase Database
 * Implementa el patrón Singleton para gestionar la conexión a la base de datos con PDO.
 */
class Database {
    private static $instance = null;
    private $pdo;
    private $stmt;

    private function __construct() {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
        $options = [
            PDO::ATTR_PERSISTENT         => true, // Mantener conexión persistente
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Manejo de errores por excepciones
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, // Retornar objetos por defecto
            PDO::ATTR_EMULATE_PREPARES   => false, // Usar consultas preparadas nativas
        ];

        try {
            $this->pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            die('Error de conexión a la base de datos: ' . $e->getMessage());
        }
    }

    /**
     * Prevenir la clonación del objeto (Singleton)
     */
    private function __clone() {}

    /**
     * Prevenir la deserialización (Singleton)
     */
    public function __wakeup() {
        throw new Exception("Cannot unserialize a singleton.");
    }

    /**
     * Obtener la única instancia de la clase Database
     * @return Database
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    /**
     * Obtener el objeto PDO directo si es necesario
     * @return PDO
     */
    public function getConnection() {
        return $this->pdo;
    }

    /**
     * Preparar una consulta SQL
     * @param string $sql
     */
    public function query($sql) {
        $this->stmt = $this->pdo->prepare($sql);
    }

    /**
     * Vincular un valor a un parámetro de la consulta
     * @param string|int $param
     * @param mixed $value
     * @param int|null $type
     */
    public function bind($param, $value, $type = null) {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    /**
     * Ejecutar la consulta preparada
     * @param array $params Opcional: parámetros para pasar directamente al execute
     * @return bool
     */
    public function execute($params = []) {
        if (!empty($params)) {
            return $this->stmt->execute($params);
        }
        return $this->stmt->execute();
    }

    /**
     * Obtener un conjunto de resultados (múltiples filas)
     * @return array
     */
    public function resultSet() {
        $this->execute();
        return $this->stmt->fetchAll();
    }

    /**
     * Obtener un único resultado (una fila)
     * @return object|false
     */
    public function single() {
        $this->execute();
        return $this->stmt->fetch();
    }

    /**
     * Obtener el conteo de filas afectadas o devueltas
     * @return int
     */
    public function rowCount() {
        return $this->stmt->rowCount();
    }

    /**
     * Obtener el último ID insertado
     * @return string|false
     */
    public function lastInsertId() {
        return $this->pdo->lastInsertId();
    }

    /**
     * Iniciar una transacción
     * @return bool
     */
    public function beginTransaction() {
        return $this->pdo->beginTransaction();
    }

    /**
     * Confirmar una transacción
     * @return bool
     */
    public function commit() {
        return $this->pdo->commit();
    }

    /**
     * Revertir una transacción
     * @return bool
     */
    public function rollBack() {
        return $this->pdo->rollBack();
    }
}

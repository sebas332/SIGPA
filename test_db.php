<?php
require_once 'Proyecto/config/Database.php';

class FichaAprendiz {
    private $db;
    public function __construct() { $this->db = Database::getInstance(); }
    public function getAprendicesPorFicha($numero_ficha) {
        $this->db->query("SELECT fa.*, u.id_usuario, u.nombre, u.apellido, u.correo, u.telefono, u.documento, u.foto 
                          FROM ficha_aprendiz fa 
                          INNER JOIN usuarios u ON fa.id_usuario_aprendiz = u.id_usuario 
                          WHERE fa.numero_ficha = :numero_ficha 
                          ORDER BY u.nombre, u.apellido");
        $this->db->bind(':numero_ficha', $numero_ficha);
        return $this->db->resultSet();
    }
}
$model = new FichaAprendiz();
$res = $model->getAprendicesPorFicha('3063365');
echo "Count for 3063365: " . count($res) . "\n";
echo "JSON: " . json_encode($res) . "\n";

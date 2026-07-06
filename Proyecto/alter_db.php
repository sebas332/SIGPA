<?php
try {
    $db = new PDO('mysql:host=127.0.0.1;dbname=bd_proyecto_final;charset=utf8mb4', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->exec("ALTER TABLE usuarios ADD COLUMN reset_token VARCHAR(255) NULL");
    $db->exec("ALTER TABLE usuarios ADD COLUMN reset_expira DATETIME NULL");
    echo "Columns added successfully";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

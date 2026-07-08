<?php
/**
 * Modelo Usuario
 * Gestiona las operaciones CRUD y autenticación de la tabla `usuarios`.
 */
class Usuario {
    private $db;
    private $resetColumnsChecked = false;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    /**
     * Obtener todos los usuarios
     * @return array
     */
    public function all() {
        $this->db->query("SELECT * FROM usuarios ORDER BY nombre, apellido");
        return $this->db->resultSet();
    }

    /**
     * Obtener un usuario por ID
     * @param int $id
     * @return object|false
     */
    public function find($id) {
        $this->db->query("SELECT * FROM usuarios WHERE id_usuario = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    /**
     * Obtener un usuario por nombre de usuario
     * @param string $username
     * @return object|false
     */
    public function findByUsername($username) {
        $this->db->query("SELECT * FROM usuarios WHERE usuario = :usuario");
        $this->db->bind(':usuario', $username);
        return $this->db->single();
    }

    /**
     * Obtener un usuario por documento
     * @param string $documento
     * @return object|false
     */
    public function findByDocumento($documento) {
        $this->db->query("SELECT * FROM usuarios WHERE documento = :documento");
        $this->db->bind(':documento', $documento);
        return $this->db->single();
    }

    /**
     * Crear un nuevo usuario
     * @param array $data
     * @return bool
     */
    public function create($data) {
        $this->db->query("INSERT INTO usuarios (nombre, apellido, documento, telefono, correo, titulacion, usuario, `contraseña`) 
                          VALUES (:nombre, :apellido, :documento, :telefono, :correo, :titulacion, :usuario, :contrasena)");
        $this->db->bind(':nombre', $data['nombre']);
        $this->db->bind(':apellido', $data['apellido']);
        $this->db->bind(':documento', $data['documento']);
        $this->db->bind(':telefono', $data['telefono']);
        $this->db->bind(':correo', $data['correo']);
        $this->db->bind(':titulacion', $data['titulacion']);
        $this->db->bind(':usuario', $data['usuario']);
        $this->db->bind(':contrasena', $data['contrasena']);
        return $this->db->execute();
    }

    /**
     * Actualizar un usuario existente
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, $data) {
        if (!empty($data['contrasena'])) {
            $this->db->query("UPDATE usuarios SET nombre = :nombre, apellido = :apellido, documento = :documento, telefono = :telefono, 
                              correo = :correo, titulacion = :titulacion, usuario = :usuario, `contraseña` = :contrasena 
                              WHERE id_usuario = :id");
            $this->db->bind(':contrasena', $data['contrasena']);
        } else {
            $this->db->query("UPDATE usuarios SET nombre = :nombre, apellido = :apellido, documento = :documento, telefono = :telefono, 
                              correo = :correo, titulacion = :titulacion, usuario = :usuario 
                              WHERE id_usuario = :id");
        }
        $this->db->bind(':nombre', $data['nombre']);
        $this->db->bind(':apellido', $data['apellido']);
        $this->db->bind(':documento', $data['documento']);
        $this->db->bind(':telefono', $data['telefono']);
        $this->db->bind(':correo', $data['correo']);
        $this->db->bind(':titulacion', $data['titulacion']);
        $this->db->bind(':usuario', $data['usuario']);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    /**
     * Actualizar los datos que el usuario puede modificar desde su propio perfil.
     */
    public function updateProfile($id, $data) {
        if (!empty($data['contrasena'])) {
            $this->db->query("UPDATE usuarios SET nombre = :nombre, apellido = :apellido, telefono = :telefono,
                              correo = :correo, titulacion = :titulacion, `contraseña` = :contrasena
                              WHERE id_usuario = :id");
            $this->db->bind(':contrasena', $data['contrasena']);
        } else {
            $this->db->query("UPDATE usuarios SET nombre = :nombre, apellido = :apellido, telefono = :telefono,
                              correo = :correo, titulacion = :titulacion WHERE id_usuario = :id");
        }
        $this->db->bind(':nombre', $data['nombre']);
        $this->db->bind(':apellido', $data['apellido']);
        $this->db->bind(':telefono', $data['telefono']);
        $this->db->bind(':correo', $data['correo']);
        $this->db->bind(':titulacion', $data['titulacion']);
        $this->db->bind(':id', (int) $id);
        return $this->db->execute();
    }

    /**
     * Eliminar un usuario
     * @param int $id
     * @return bool
     */
    public function delete($id) {
        try {
            $this->db->beginTransaction();

            // Eliminar dependencias en ficha_aprendiz
            $this->db->query("DELETE FROM ficha_aprendiz WHERE id_usuario_aprendiz = :id");
            $this->db->bind(':id', $id);
            $this->db->execute();

            // Eliminar dependencias en usuario_rol
            $this->db->query("DELETE FROM usuario_rol WHERE id_usuario = :id");
            $this->db->bind(':id', $id);
            $this->db->execute();

            // Eliminar el usuario
            $this->db->query("DELETE FROM usuarios WHERE id_usuario = :id");
            $this->db->bind(':id', $id);
            $this->db->execute();

            return $this->db->commit();
        } catch (\PDOException $e) {
            $this->db->rollBack();
            return false;
        }
    }

    /**
     * Obtener los roles asociados a un usuario
     * @param int $id_usuario
     * @return array
     */
    public function getRoles($id_usuario) {
        $this->db->query("SELECT r.* FROM rol r 
                          INNER JOIN usuario_rol ur ON r.id_rol = ur.id_rol 
                          WHERE ur.id_usuario = :id_usuario");
        $this->db->bind(':id_usuario', $id_usuario);
        return $this->db->resultSet();
    }

    /**
     * Autenticar credenciales de usuario
     * @param string $username
     * @param string $password
     * @return object|false Retorna el objeto usuario si es exitoso, false en caso contrario
     */
    public function authenticate($username, $password) {
        $user = $this->findByUsername($username);
        if ($user) {
            // Soportar tanto las contraseñas de prueba precargadas (ej. 'hashed_pass_123') 
            // como contraseñas en texto plano (por si el usuario introduce la misma) o hasheadas
            if ($password === $user->contraseña || password_verify($password, $user->contraseña)) {
                return $user;
            }
        }
        return false;
    }

    /**
     * Actualizar dinámicamente columnas específicas en el perfil de usuario.
     * @param int $id
     * @param array $fields
     * @return bool
     */
    public function updateProfileFields($id, $fields) {
        if (empty($fields)) {
            return true;
        }
        $query = "UPDATE usuarios SET ";
        $sets = [];
        foreach ($fields as $column => $value) {
            $colName = ($column === 'contrasena') ? '`contraseña`' : $column;
            $sets[] = "{$colName} = :{$column}";
        }
        $query .= implode(', ', $sets);
        $query .= " WHERE id_usuario = :id";
        
        $this->db->query($query);
        foreach ($fields as $column => $value) {
            $this->db->bind(":{$column}", $value);
        }
        $this->db->bind(':id', (int) $id);
        return $this->db->execute();
    }

    /**
     * Verificar si un correo electrónico ya está registrado por otro usuario.
     */
    public function emailExistsForOtherUser($email, $userId) {
        $this->db->query("SELECT id_usuario FROM usuarios WHERE correo = :correo AND id_usuario != :id LIMIT 1");
        $this->db->bind(':correo', $email);
        $this->db->bind(':id', $userId);
        return $this->db->single() !== false;
    }

    /**
     * Buscar un usuario por su correo electrónico.
     * @param string $email
     * @return object|false
     */
    public function findByEmail($email) {
        $this->db->query("SELECT * FROM usuarios WHERE correo = :correo");
        $this->db->bind(':correo', $email);
        return $this->db->single();
    }

    /**
     * Garantiza que la tabla usuarios tenga las columnas requeridas para recuperar contraseña.
     */
    private function ensurePasswordResetColumns() {
        if ($this->resetColumnsChecked) {
            return;
        }

        $pdo = $this->db->getConnection();
        $requiredColumns = [
            'reset_token' => "ALTER TABLE usuarios ADD COLUMN reset_token VARCHAR(255) NULL AFTER `contraseña`",
            'reset_expira' => "ALTER TABLE usuarios ADD COLUMN reset_expira DATETIME NULL AFTER reset_token"
        ];

        foreach ($requiredColumns as $column => $alterSql) {
            $stmt = $pdo->prepare("SHOW COLUMNS FROM usuarios LIKE :column_name");
            $stmt->execute([':column_name' => $column]);
            if (!$stmt->fetch()) {
                $pdo->exec($alterSql);
            }
        }

        $this->resetColumnsChecked = true;
    }

    /**
     * Guardar el token de restablecimiento de contraseña y su expiración.
     * @param int $userId
     * @param string $token
     * @param string $expiry
     * @return bool
     */
    public function saveResetToken($userId, $token, $expiry) {
        $this->ensurePasswordResetColumns();
        $this->db->query("UPDATE usuarios SET reset_token = :token, reset_expira = :expiry WHERE id_usuario = :id");
        $this->db->bind(':token', $token);
        $this->db->bind(':expiry', $expiry);
        $this->db->bind(':id', (int) $userId);
        return $this->db->execute();
    }

    /**
     * Buscar un usuario que posea un determinado token de restablecimiento activo (no vencido).
     * @param string $token
     * @return object|false
     */
    public function findByResetToken($token) {
        $this->ensurePasswordResetColumns();
        $this->db->query("SELECT * FROM usuarios WHERE reset_token = :token AND reset_expira > NOW() LIMIT 1");
        $this->db->bind(':token', $token);
        return $this->db->single();
    }

    /**
     * Actualizar contraseña de usuario y limpiar columnas del token.
     * @param int $userId
     * @param string $hashedPassword
     * @return bool
     */
    public function updatePasswordAndClearToken($userId, $hashedPassword) {
        $this->ensurePasswordResetColumns();
        $this->db->query("UPDATE usuarios SET `contraseña` = :pass, reset_token = NULL, reset_expira = NULL WHERE id_usuario = :id");
        $this->db->bind(':pass', $hashedPassword);
        $this->db->bind(':id', (int) $userId);
        return $this->db->execute();
    }
}

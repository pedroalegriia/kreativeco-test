<?php
require_once 'config/database.php';
require_once __DIR__ . '/../models/User.php';

class UserRepository {
    private $pdo;

    public function __construct($pdo) 
    {
        $this->pdo = $pdo;
    }

    public function obtenerUsuarios() 
    {
        try {
            $stmt = $this->pdo->query("SELECT id, nombre, apellido, email, rol_id FROM usuarios");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function crearUsuario($nombre, $apellido, $email, $password, $rol_id) 
    {
        try {
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $this->pdo->prepare("INSERT INTO usuarios (nombre, apellido, email, password, rol_id) VALUES (?, ?, ?, ?, ?)");
            return $stmt->execute([$nombre, $apellido, $email, $passwordHash, $rol_id]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function actualizarUsuario($id, $nombre, $apellido, $email) 
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE usuarios SET nombre = ?, apellido = ?, email = ? WHERE id = ?");
            return $stmt->execute([$nombre, $apellido, $email, $id]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function eliminarUsuario($id) 
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM usuarios WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function autenticarUsuario($email, $password) 
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
            $stmt->execute([$email]);
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($userData) {
                if (password_verify($password, $userData['password'])) {
                    return new User(
                        $userData['id'],       
                        $userData['nombre'],    
                        $userData['apellido'],
                        $userData['email'],
                        $userData['password'],   
                        $userData['rol_id']    
                    );
                }
            }
            return null;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }
}
?>
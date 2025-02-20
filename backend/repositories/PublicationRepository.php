<?php

require_once __DIR__ . '/../config/database.php';

class PublicationRepository {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function crearPublicacion($titulo, $descripcion, $usuarioId) 
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO publicaciones (titulo, descripcion, usuario_id) VALUES (?, ?, ?)");
            return $stmt->execute([$titulo, $descripcion, $usuarioId]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function actualizarPublicacion($id, $titulo, $descripcion) 
    {
        try {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM publicaciones WHERE id = ?");
            $stmt->execute([$id]);
            $exists = $stmt->fetchColumn();

            if ($exists) {
                $stmt = $this->pdo->prepare("UPDATE publicaciones SET titulo = ?, descripcion = ? WHERE id = ?");
                return $stmt->execute([$titulo, $descripcion, $id]);
            } else {
                return false;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function eliminarPublicacion($id) 
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM publicaciones WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false; 
        }
    }

    public function obtenerPublicaciones() 
    {
        try {
            $stmt = $this->pdo->prepare("
                SELECT p.*, u.nombre AS nombre_usuario
                FROM publicaciones p
                LEFT JOIN usuarios u ON p.usuario_id = u.id
             ");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }
}
?>
<?php
require_once __DIR__ . '/../repositories/PublicationRepository.php'; // Asegúrate de que esta ruta sea correcta

class PublicationController {
    private $publicationRepository;

    public function __construct($pdo) {
        $this->publicationRepository = new PublicationRepository($pdo);
    }

    public function crearPublicacion($data, $usuarioId) {
        if (empty($data['titulo']) || empty($data['descripcion'])) {
            http_response_code(400);
            return json_encode(['message' => 'Título y descripción son obligatorios']);
        }

        if ($this->publicationRepository->crearPublicacion($data['titulo'], $data['descripcion'], $usuarioId)) {
            return json_encode(['message' => 'Publicación creada']);
        } else {
            http_response_code(500);
            return json_encode(['message' => 'Error al crear publicación']);
        }
    }

    public function actualizarPublicacion($id, $data) {
        if ($this->publicationRepository->actualizarPublicacion($id, $data['titulo'], $data['descripcion'])) {
            return json_encode(['message' => 'Publicación actualizada']);
        } else {
            return json_encode(['message' => 'Error al actualizar publicación']);
        }
    }

    public function eliminarPublicacion($id) {
        if ($this->publicationRepository->eliminarPublicacion($id)) {
            return json_encode(['message' => 'Publicación eliminada lógicamente']);
        } else {
            return json_encode(['message' => 'Error al eliminar publicación']);
        }
    }

    public function obtenerPublicaciones() {
        return json_encode($this->publicationRepository->obtenerPublicaciones());
    }
}
?>
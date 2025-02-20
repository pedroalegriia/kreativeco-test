<?php
// routes/api.php

require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../controllers/PublicationController.php';

$usuarioController = new UserController($pdo);
$publicacionController = new PublicationController($pdo);

$method = $_SERVER['REQUEST_METHOD'];
$uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

try {
    switch ($method) {
        case 'POST':
            if (isset($uri[0]) && $uri[0] == 'login') {
                $data = json_decode(file_get_contents("php://input"), true);
                echo $usuarioController->login($data);
            } elseif (isset($uri[0]) && $uri[0] == 'usuarios') {
                $data = json_decode(file_get_contents("php://input"), true);
                echo $usuarioController->registrarUsuario($data);
            } elseif (isset($uri[0]) && $uri[0] == 'publicaciones') {
                $decoded = verificarToken();
                $usuarioId = $decoded['usuario_id'];
                $data = json_decode(file_get_contents("php://input"), true);
                echo $publicacionController->crearPublicacion($data, $usuarioId);
            }
            break;

        case 'GET':
            if (isset($uri[0]) && $uri[0] == 'publicaciones') {
                 verificarToken();
                echo $publicacionController->obtenerPublicaciones();
            }
            break;

        case 'PUT':
            if (isset($uri[0]) && $uri[0] == 'publicaciones' && isset($uri[1])) {
                 verificarToken();
                $data = json_decode(file_get_contents("php://input"), true);
                echo $publicacionController->actualizarPublicacion($uri[1], $data);
            }
            break;

        case 'DELETE':
            if (isset($uri[0]) && $uri[0] == 'publicaciones' && isset($uri[1])) {
                verificarToken();
                echo $publicacionController->eliminarPublicacion($uri[1]);
            }
            break;

        default:
            http_response_code(405);
            echo json_encode(['message' => 'Método no permitido']);
            break;
    }
} catch (Exception $e) {

    http_response_code(500);
    echo json_encode(['message' => 'Error en el servidor', 'error' => $e->getMessage()]);
}
?>
<?php
require 'services/AuthService.php';

function verificarToken() {
    $headers = getallheaders();
    
    if (!isset($headers['Authorization'])) {
        http_response_code(401);
        echo json_encode(['message' => 'Token no proporcionado']);
        exit;
    }

    $token = str_replace('Bearer ', '', $headers['Authorization']);
    $decoded = validarToken($token);

    if (!$decoded) {
        http_response_code(401);
        echo json_encode(['message' => 'Token inválido']);
        exit;
    }

    return (array) $decoded; 
}

?>
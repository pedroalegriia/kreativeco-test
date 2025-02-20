<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function generarToken($user) {
    $key = "clave_secreta"; 
    $payload = [
        'iat' => time(), 
        'exp' => time() + (60 * 60),
        'usuario_id' => $user->id,
        'rol_id' => $user->rol_id
    ];
    
    $token = JWT::encode($payload, $key, 'HS256');

    return [
        'token' => $token,
        'usuario_id' => $user->id,
        'nombre' => $user->nombre,
        'apellido' => $user->apellido,
        'rol_id' => $user->rol_id
    ];
}

function validarToken($token) {
    $key = "clave_secreta"; 
    try {
        var_dump($token); // Muestra el token recibido
        return JWT::decode($token, new Key($key, 'HS256'));
    } catch (Exception $e) {
        error_log($e->getMessage()); // Registra el error
        return null; // Retorna null si el token es inválido
    }
}
?>
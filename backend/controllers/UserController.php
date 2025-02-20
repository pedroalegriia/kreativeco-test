<?php
require_once 'services/AuthService.php';
require_once __DIR__ . '/../repositories/UserRepository.php';

class UserController {
    private $usuarioRepository;

    public function __construct($pdo) {
        $this->usuarioRepository = new UserRepository($pdo);
    }

    public function login($data) {

        if (empty($data['email']) || empty($data['password'])) {
            http_response_code(400);
            return json_encode(['message' => 'Email y contraseña son obligatorios']);
        }

        $usuario = $this->usuarioRepository->autenticarUsuario($data['email'], $data['password']);
        if ($usuario) {
            $token = generarToken($usuario);
            return json_encode(['data' => $token]);
        } else {
            http_response_code(401);
            return json_encode(['message' => 'Credenciales incorrectas']);
        }
    }

    public function registrarUsuario($data) {
        if (empty($data['nombre']) || empty($data['apellido']) || empty($data['email']) || empty($data['password']) || empty($data['rol_id'])) {
            http_response_code(400);
            return json_encode(['message' => 'Todos los campos son obligatorios']);
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            return json_encode(['message' => 'Email no válido']);
        }

        if ($this->usuarioRepository->crearUsuario($data['nombre'], $data['apellido'], $data['email'], $data['password'], $data['rol_id'])) {
            return json_encode(['message' => 'Usuario creado']);
        } else {
            http_response_code(500);
            return json_encode(['message' => 'Error al crear usuario']);
        }
    }
}
?>
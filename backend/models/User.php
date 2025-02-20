<?php
class User {
    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $rol_id;

    public function __construct($id, $nombre, $apellido, $email, $password, $rol_id) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->password = $password;
        $this->rol_id = $rol_id;
    }
}
?>
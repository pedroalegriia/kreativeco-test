<?php
class Publication {
    public $id;
    public $titulo;
    public $descripcion;
    public $fecha_creacion;
    public $usuario_id;

    public function __construct($id, $titulo, $descripcion , $fecha_creacion, $usuario_id) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->fecha_creacion = $fecha_creacion;
        $this->usuario_id = $usuario_id;
    }
}
?>
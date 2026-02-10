<?php
class MenuDTO {
    public $titulo;
    public $url;
    public $icono;

    public function __construct($titulo, $url, $icono) {
        $this->titulo = $titulo;
        $this->url = $url;
        $this->icono = $icono;
    }
}
?>
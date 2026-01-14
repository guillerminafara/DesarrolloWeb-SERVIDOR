<?php
class Revista{
    public $isbn;
    public $titulo;
    public $anyo;
    public $nPublicaciones;
    function __construct($isbn, $titulo, $anyo, $nPublicaciones)
    {   $this->isbn= $isbn;
        $this->titulo=$titulo;
        $this->anyo = $anyo===null?? 2024;
        $this-> nPublicaciones= $nPublicaciones;
    }


    function __tostring(){
        return " \nLibro: ISBN:". (string)$this->isbn.", Título: $this->titulo, año de publicación: ".(string)$this->anyo. "número: ".(string)$this->nPublicaciones; 
    }
}
?>
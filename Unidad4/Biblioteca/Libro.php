<?php
class Libro
{
    public $isbn;
    public $titulo;
    public $anyo;
    // public $prestado;
    public static $prestado;
    // public $estado;
    function __construct($isbn, $titulo, $anyo)
    {
        $this->isbn = $isbn;
        $this->titulo = $titulo;
        $this->anyo = $anyo ?? 2024;
        // $this->prestado = false;
        self::$prestado=false;
    }
    function presta()
    {

        // if ($this->prestado === false) {
        if(self::$prestado===false){

            // $this->prestado = true;
            self::$prestado=true;
            print ("\nSe ha prestado el libro '$this->titulo' \n");
        }else{
            print("\nNo se ha podido prestar el libro '$this->titulo' ya está prestado \n");
        }

    }
    function mostrarPrestado()
    {
        // if ($this->prestado === true) {
        if(self::$prestado===true){

            print ("\nEl libro '$this->titulo' está prestado\n ");
        } else {
            print ("\n El libro '$this->titulo' se encuentra disponible\n");
        }
    }
    function devuelve()
    {
        // if($this->prestado===true){
        if(self::$prestado===true){
            // $this->prestado=false;
            self::$prestado=false;
            print("\nSe ha devuelto el libro '$this->titulo' \n ");
        }else{
            print("\nEl libro '$this->titulo' se encuentra disponible\n "); 
        }
    }
    function __tostring()
    {
        // $salida= $this->prestado===true? "(prestado)": "(no prestado)";
            
        $salida= self::$prestado===true?"(prestado)": "(no prestado)" ;
        return "\nLibro: ISBN:". (string)$this->isbn.", Título: '$this->titulo', año de publicación: ".(string)$this->anyo. $salida ;
    }
}

?>
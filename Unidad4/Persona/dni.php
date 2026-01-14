<?php
trait DNI
{
    public function generarDNI()
    {
        $numeroAleatorio= rand(10000000,99999999);
        $resto= $numeroAleatorio/23;
        $letra=$this->generarLetraDNI($resto);
        return "$numeroAleatorio $letra";
    }
    private function generarLetraDNI($idLetra)
    {
        $letras = [
            'T','R','W','A','G','M','Y','F','P','D','X','B','N','J','Z','S','Q','V','H','L',
            'C','K','E'
        ];
        return $letras[$idLetra];
    }

}

?>
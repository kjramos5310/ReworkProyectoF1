<?php

class Persona {
    protected $nombre;
    protected $apellido;
    protected $edad;

    public function __construct() {
        // Inicialización si es necesario
    }

    public function leerDatosXML($xml) {
        $this->nombre = (string)$xml->nombre;
        $this->apellido = (string)$xml->apellido;
        $this->edad = (int)$xml->edad;
    }

    public function obtenerDatos() {
        echo "<p>Nombre: $this->nombre $this->apellido</p>";
        echo "<p>Edad: $this->edad</p>";
    }
}
?>

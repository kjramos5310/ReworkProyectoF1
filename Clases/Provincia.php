<?php
require_once 'Clases/Ciudad.php';

class Provincia {
    private $nombreProvincia;
    private $numCiudades;
    private $ciudades;

    public function __construct() {
        $this->ciudades = [];
    }

    public function leerDatosXML($xml) {
        $this->nombreProvincia = (string)$xml->nombreProvincia;
        $this->numCiudades = (int)$xml->numCiudades;
        if (isset($xml->Ciudad)) {
            foreach ($xml->Ciudad as $ciudadXML) {
                $ciudad = new Ciudad();
                $ciudad->leerDatosXML($ciudadXML);
                $this->ciudades[] = $ciudad;
            }
        }
    }

    public function imprimir() {
        echo "<p>Provincia: $this->nombreProvincia</p>";
        echo "<p>Número de Ciudades: $this->numCiudades</p>";
        foreach ($this->ciudades as $ciudad) {
            $ciudad->imprimir();
        }
    }
}
?>

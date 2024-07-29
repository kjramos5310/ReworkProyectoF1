<?php

class Ciudad {
    private $nombreCiudad;
    private $codPostal;

    public function leerDatosXML($xml) {
        $this->nombreCiudad = (string)$xml->nombreCiudad;
        $this->codPostal = (string)$xml->codPostal;
    }

    protected function imprimir() {
        echo "<p>Ciudad: $this->nombreCiudad</p>";
        echo "<p>Código Postal: $this->codPostal</p>";
    }
}
?>

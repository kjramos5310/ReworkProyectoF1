<?php

class Pais {
    private $nombrePais;
    private $moneda;
    private $bandera;
    private $continente;
    private $provincias;

    public function __construct() {
        $this->provincias = [];
    }

    public function leerDatosXML($xml) {
        $this->nombrePais = (string)$xml->nombrePais;
        $this->moneda = (string)$xml->moneda;
        $this->bandera = (string)$xml->bandera;
        $this->continente = (string)$xml->continente;
        if (isset($xml->Provincia)) {
            foreach ($xml->Provincia as $provinciaXML) {
                $provincia = new Provincia();
                $provincia->leerDatosXML($provinciaXML);
                $this->provincias[] = $provincia;
            }
        }
    }

    public function imprimir() {
        echo "<p>País: $this->nombrePais</p>";
        echo "<p>Moneda: $this->moneda</p>";
        echo "<p>Continente: $this->continente</p>";
    }
}
?>

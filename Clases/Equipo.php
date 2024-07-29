<?php
require_once 'Puntaje.php';
require_once 'Pais.php';

class Equipo implements Puntaje {
    private $nombreEquipo;
    private $jefeEquipo;
    private $motor;
    private $chasis;
    private $pilotos = [];
    private $pais;

    public function leerDatosXML($xml) {
        $this->nombreEquipo = (string)$xml->nombreEquipo;
        $this->jefeEquipo = (string)$xml->jefeEquipo;
        $this->motor = (string)$xml->motor;
        $this->chasis = (string)$xml->chasis;

        $this->pais = new Pais();
        $this->pais->leerDatosXML($xml->Pais);

        foreach ($xml->Piloto as $pilotoXml) {
            $piloto = new Piloto();
            $piloto->leerDatosXML($pilotoXml);
            $this->pilotos[] = $piloto;
        }
    }

    public function imprimirDatos() {
        echo "<p>Nombre del Equipo: $this->nombreEquipo</p>";
        echo "<p>Jefe del Equipo: $this->jefeEquipo</p>";
        echo "<p>Motor: $this->motor</p>";
        echo "<p>Chasis: $this->chasis</p>";
        echo "<h4>País:</h4>";
        $this->pais->imprimirDatos();
        echo "<h4>Pilotos:</h4>";
        foreach ($this->pilotos as $piloto) {
            $piloto->obtenerDatos();
        }
    }

    public function calcularPosicion() {
        // Implementar la lógica para calcular la posición
    }

    public function calcularPuntajes() {
        // Implementar la lógica para calcular los puntajes
    }
}
?>

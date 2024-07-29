<?php
class Piloto {
    private $nombre;
    private $escuderia;
    private $posicion;
    private $numeroCoche;
    private $pais;
    private $vueltasCompletadas;
    private $tiempo;
    private $mejorVuelta;
    private $puntos;

    public function __construct($nombre, $escuderia, $posicion, $numeroCoche, $pais, $vueltasCompletadas, $tiempo, $mejorVuelta, $puntos) {
        $this->nombre = $nombre;
        $this->escuderia = $escuderia;
        $this->posicion = $posicion;
        $this->numeroCoche = $numeroCoche;
        $this->pais = $pais;
        $this->vueltasCompletadas = $vueltasCompletadas;
        $this->tiempo = $tiempo;
        $this->mejorVuelta = $mejorVuelta;
        $this->puntos = $puntos;
    }

    public function imprimir() {
        echo "Nombre: {$this->nombre}<br>";
        echo "Escudería: {$this->escuderia}<br>";
        echo "Posición: {$this->posicion}<br>";
        echo "Número del coche: {$this->numeroCoche}<br>";
        echo "País: {$this->pais}<br>";
        echo "Vueltas completadas: {$this->vueltasCompletadas}<br>";
        echo "Tiempo: {$this->tiempo}<br>";
        echo "Mejor vuelta: {$this->mejorVuelta}<br>";
        echo "Puntos: {$this->puntos}<br><br>";
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getEscuderia() {
        return $this->escuderia;
    }

    public function getPosicion() {
        return $this->posicion;
    }

    public function getNumeroCoche() {
        return $this->numeroCoche;
    }

    public function getPais() {
        return $this->pais;
    }

    public function getVueltasCompletadas() {
        return $this->vueltasCompletadas;
    }

    public function getTiempo() {
        return $this->tiempo;
    }

    public function getMejorVuelta() {
        return $this->mejorVuelta;
    }

    public function getPuntos() {
        return $this->puntos;
    }
}
?>

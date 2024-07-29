<?php
class Circuito {
    private $nombre;
    private $ubicacion;
    private $longitud;
    private $vueltas;

    public function __construct($nombre, $ubicacion, $longitud, $vueltas) {
        $this->nombre = $nombre;
        $this->ubicacion = $ubicacion;
        $this->longitud = $longitud;
        $this->vueltas = $vueltas;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getUbicacion() {
        return $this->ubicacion;
    }

    public function getLongitud() {
        return $this->longitud;
    }

    public function getVueltas() {
        return $this->vueltas;
    }
}
?>

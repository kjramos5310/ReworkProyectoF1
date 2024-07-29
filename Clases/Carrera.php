<?php
class Carrera {
    private $nombre;
    private $fecha;
    private $circuito;
    private $resultados;
    private $incidentes;

    public function __construct($nombre = '', $fecha = '', $circuito = null, $resultados = [], $incidentes = []) {
        $this->nombre = $nombre;
        $this->fecha = $fecha;
        $this->circuito = $circuito;
        $this->resultados = $resultados;
        $this->incidentes = $incidentes;
    }

    public static function fromXMLFile($filePath) {
        try {
            $lector = new LectorXML($filePath);
            $carrera = new Carrera();

            $carrera->nombre = $lector->getRaceName();
            $carrera->fecha = $lector->getRaceDate();

            $circuitInfo = $lector->getCircuitInfo();
            $carrera->circuito = new Circuito(
                $circuitInfo['Nombre'],
                $circuitInfo['Ubicacion'],
                $circuitInfo['Longitud'],
                $circuitInfo['Vueltas']
            );

            $resultados = $lector->getResults();
            foreach ($resultados as $pilotoInfo) {
                $piloto = new Piloto(
                    $pilotoInfo['Nombre'],
                    $pilotoInfo['Escuderia'],
                    $pilotoInfo['Posicion'],
                    $pilotoInfo['NumeroCoche'],
                    $pilotoInfo['Pais'],
                    $pilotoInfo['VueltasCompletadas'],
                    $pilotoInfo['Tiempo'],
                    $pilotoInfo['MejorVuelta'],
                    $pilotoInfo['Puntos']
                );
                $carrera->resultados[] = $piloto;
            }

            $carrera->incidentes = $lector->getIncidents();

            return $carrera;
        } catch (Exception $e) {
            echo "Error al cargar la carrera desde el archivo XML: " . $e->getMessage();
            return null;
        }
    }

    public static function fromXMLClasificacionFile($filePath) {
        try {
            $lector = new LectorXML($filePath);
            $carrera = new Carrera();

            $carrera->nombre = $lector->getRaceName();
            $carrera->fecha = $lector->getRaceDate();

            $resultados = $lector->getResults();
            foreach ($resultados as $pilotoInfo) {
                $piloto = new Piloto(
                    $pilotoInfo['Nombre'],
                    $pilotoInfo['Escuderia'],
                    $pilotoInfo['Posicion'],
                    $pilotoInfo['NumeroCoche'],
                    $pilotoInfo['Pais'],
                    $pilotoInfo['VueltasCompletadas'],
                    $pilotoInfo['Tiempo'],
                    $pilotoInfo['MejorVuelta'],
                    $pilotoInfo['Puntos']
                );
                $carrera->resultados[] = $piloto;
            }

            return $carrera;
        } catch (Exception $e) {
            echo "Error al cargar la clasificación desde el archivo XML: " . $e->getMessage();
            return null;
        }
    }

    public function imprimirResultados() {
        echo "Resultados de la Carrera - {$this->fecha}<br>" .
        "Detalles del Circuito:<br>" .
        "Nombre: {$this->circuito->getNombre()}<br>" .
        "Ubicación: {$this->circuito->getUbicacion()}<br>" .
        "Longitud: {$this->circuito->getLongitud()} km<br>" .
        "Vueltas: {$this->circuito->getVueltas()}<br>";

        echo "Equipos Participantes:<br>";
        foreach ($this->resultados as $resultado) {
            $resultado->imprimir();
        }

        echo "Incidentes:<br>";
        foreach ($this->incidentes as $incidente) {
            echo "Vueltas: {$incidente['Vueltas']}<br>";
            echo "Descripción: {$incidente['Descripcion']}<br>";
            echo "Consecuencias: {$incidente['Consecuencias']}<br><br>";
        }
    }

    public function imprimirClasificacion() {
        echo "Clasificación:<br>";
        foreach ($this->resultados as $resultado) {
            $resultado->imprimir();
        }
    }

    // Método para imprimir los resultados en una tabla HTML usando Bootstrap
    public function imprimirResultadosEnTabla() {
        echo '<div class="container">
        <div class="table-container">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Escudería</th>
                        <th>Posición</th>
                        <th>Número del coche</th>
                        <th>País</th>
                        <th>Vueltas completadas</th>
                        <th>Tiempo</th>
                        <th>Mejor vuelta</th>
                        <th>Puntos</th>
                    </tr>
                </thead>
                <tbody>';


        foreach ($this->resultados as $resultado) {
            echo '<tr>
                    <td>' . $resultado->getNombre() . '</td>
                    <td>' . $resultado->getEscuderia() . '</td>
                    <td>' . $resultado->getPosicion() . '</td>
                    <td>' . $resultado->getNumeroCoche() . '</td>
                    <td>' . $resultado->getPais() . '</td>
                    <td>' . $resultado->getVueltasCompletadas() . '</td>
                    <td>' . $resultado->getTiempo() . '</td>
                    <td>' . $resultado->getMejorVuelta() . '</td>
                    <td>' . $resultado->getPuntos() . '</td>
                </tr>';

        }

        echo '</tbody>,
            </table>,
            </div>,
            </div>';
    }

    public function getClasificacionResults()
{
    $resultados = [];
    if (isset($this->xml->Sesion->Resultados->Piloto)) {
        foreach ($this->xml->Sesion->Resultados->Piloto as $piloto) {
            $resultados[] = [
                'Nombre' => (string)$piloto->Nombre,
                'Escuderia' => (string)$piloto->Escuderia,
                'Posicion' => (int)$piloto->Posicion,
                'NumeroCoche' => (int)$piloto->NumeroCoche,
                'Pais' => (string)$piloto->Pais,
                'Tiempo' => (string)$piloto->Tiempo,
                'VueltasRapidas' => (int)$piloto->VueltasRapidas
            ];
        }
    }
    return $resultados;
}

    // Método para imprimir los resultados en una tabla HTML usando Bootstrap para clasificación
    public function imprimirClasificacionEnTabla() {
        echo "Clasificacion:<br>";
        echo '<div class="container">
        <div class="table-container">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Escudería</th>
                        <th>Posición</th>
                        <th>Número del coche</th>
                        <th>País</th>
                        <th>Tiempo</th>
                        <th>Vueltas rápidas</th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($this->resultados as $resultado) {
            echo '<tr>
                    <td>' . $resultado->getNombre() . '</td>
                    <td>' . $resultado->getEscuderia() . '</td>
                    <td>' . $resultado->getPosicion() . '</td>
                    <td>' . $resultado->getNumeroCoche() . '</td>
                    <td>' . $resultado->getPais() . '</td>
                    <td>' . $resultado->getTiempo() . '</td>
                    <td>' . $resultado->getVueltasRapidas() . '</td>
                </tr>';
        }

        echo '</tbody>
            </table>
            </div>
            </div>';
    }
}
?>
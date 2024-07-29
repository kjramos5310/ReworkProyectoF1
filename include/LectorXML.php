<?php

class LectorXML
{
    private $xml;

    public function __construct($filePath)
    {
        if (file_exists($filePath)) {
            $this->xml = simplexml_load_file($filePath);
        } else {
            throw new Exception("El archivo XML no se encontró: " . $filePath);
        }
    }

    // Obtener el nombre de la carrera
    public function getRaceName()
    {
        return isset($this->xml->Carrera->Nombre) ? (string)$this->xml->Carrera->Nombre : '';
    }

    // Obtener la fecha de la carrera
    public function getRaceDate()
    {
        return isset($this->xml->Carrera->Fecha) ? (string)$this->xml->Carrera->Fecha : '';
    }

    // Obtener información del circuito
    public function getCircuitInfo()
    {
        $circuito = $this->xml->Carrera->Circuito;
        return [
            'Nombre' => isset($circuito->Nombre) ? (string)$circuito->Nombre : '',
            'Ubicacion' => isset($circuito->Ubicacion) ? (string)$circuito->Ubicacion : '',
            'Longitud' => isset($circuito->Longitud) ? (float)$circuito->Longitud : 0.0,
            'Vueltas' => isset($circuito->Vueltas) ? (int)$circuito->Vueltas : 0
        ];
    }

    // Obtener resultados de los pilotos
    public function getResults()
    {
        $resultados = [];
        if (isset($this->xml->Carrera->Resultados)) {
            foreach ($this->xml->Carrera->Resultados->Piloto as $piloto) {
                $resultados[] = [
                    'Nombre' => isset($piloto->Nombre) ? (string)$piloto->Nombre : '',
                    'Escuderia' => isset($piloto->Escuderia) ? (string)$piloto->Escuderia : '',
                    'Posicion' => isset($piloto->Posicion) ? (int)$piloto->Posicion : 0,
                    'NumeroCoche' => isset($piloto->NumeroCoche) ? (int)$piloto->NumeroCoche : 0,
                    'Pais' => isset($piloto->Pais) ? (string)$piloto->Pais : '',
                    'VueltasCompletadas' => isset($piloto->VueltasCompletadas) ? (int)$piloto->VueltasCompletadas : 0,
                    'Tiempo' => isset($piloto->Tiempo) ? (string)$piloto->Tiempo : '',
                    'MejorVuelta' => isset($piloto->MejorVuelta) ? (string)$piloto->MejorVuelta : '',
                    'Puntos' => isset($piloto->Puntos) ? (int)$piloto->Puntos : 0
                ];
            }
        }
        return $resultados;
    }

    // Obtener incidentes
    public function getIncidents()
    {
        $incidentes = [];
        if (isset($this->xml->Carrera->Incidentes)) {
            foreach ($this->xml->Carrera->Incidentes->Incidente as $incidente) {
                $incidentes[] = [
                    'Vueltas' => isset($incidente->Vueltas) ? (int)$incidente->Vueltas : 0,
                    'Descripcion' => isset($incidente->Descripcion) ? (string)$incidente->Descripcion : '',
                    'Consecuencias' => isset($incidente->Consecuencias) ? (string)$incidente->Consecuencias : ''
                ];
            }
        }
        return $incidentes;
    }

    // Obtener información de la clasificación
    public function getClasificacionRaceName()
    {
        return isset($this->xml->Sesion->Nombre) ? (string)$this->xml->Sesion->Nombre : '';
    }

    public function getClasificacionRaceDate()
    {
        return isset($this->xml->Sesion->Fecha) ? (string)$this->xml->Sesion->Fecha : '';
    }

    // Obtener resultados de los pilotos de la clasificación
    public function getClasificacionResults()
    {
        $resultados = [];
        if (isset($this->xml->Sesion->Resultados)) {
            foreach ($this->xml->Sesion->Resultados->Piloto as $piloto) {
                $resultados[] = [
                    'Nombre' => isset($piloto->Nombre) ? (string)$piloto->Nombre : '',
                    'Escuderia' => isset($piloto->Escuderia) ? (string)$piloto->Escuderia : '',
                    'Posicion' => isset($piloto->Posicion) ? (int)$piloto->Posicion : 0,
                    'NumeroCoche' => isset($piloto->NumeroCoche) ? (int)$piloto->NumeroCoche : 0,
                    'Pais' => isset($piloto->Pais) ? (string)$piloto->Pais : '',
                    'Tiempo' => isset($piloto->Tiempo) ? (string)$piloto->Tiempo : '',
                    'VueltasRapidas' => isset($piloto->VueltasRapidas) ? (int)$piloto->VueltasRapidas : 0
                ];
            }
        }
        return $resultados;
    }

    // Obtener incidentes de la clasificación
    public function getClasificacionIncidents()
    {
        $incidentes = [];
        if (isset($this->xml->Sesion->Incidentes)) {
            foreach ($this->xml->Sesion->Incidentes->Incidente as $incidente) {
                $incidentes[] = [
                    'Vueltas' => isset($incidente->Vueltas) ? (int)$incidente->Vueltas : 0,
                    'Descripcion' => isset($incidente->Descripcion) ? (string)$incidente->Descripcion : '',
                    'Consecuencias' => isset($incidente->Consecuencias) ? (string)$incidente->Consecuencias : ''
                ];
            }
        }
        return $incidentes;
    }

    // Obtener información de los directivos de la clasificación
    public function getDirectivosInfo()
    {
        $directivos = [];
        if (isset($this->xml->Sesion->Directivos)) {
            foreach ($this->xml->Sesion->Directivos->JefeDeEquipo as $jefe) {
                $directivos[] = [
                    'Nombre' => isset($jefe->Nombre) ? (string)$jefe->Nombre : '',
                    'Escuderia' => isset($jefe->Escuderia) ? (string)$jefe->Escuderia : ''
                ];
            }
            $directivos['DirectorDeCarrera'] = isset($this->xml->Sesion->Directivos->DirectorDeCarrera) ? (string)$this->xml->Sesion->Directivos->DirectorDeCarrera : '';
        }
        return $directivos;
    }
}
?>

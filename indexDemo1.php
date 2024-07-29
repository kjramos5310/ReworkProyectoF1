<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de la Carrera</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Resultados de la Carrera</h1>
        <?php
            require_once 'include/LectorXML.php';
            require_once 'Clases/Carrera.php';
            require_once 'Clases/Circuito.php';
            require_once 'Clases/Piloto.php';

            $carrera = Carrera::fromXMLFile('./Recursos/Fechas/Fecha_1/carrera.xml');
            if ($carrera !== null) {
                $carrera->imprimirResultadosEnTabla();
            }

            $clasificacion = Carrera::fromXMLFile('./Recursos/Fechas/Fecha_2/clasificacion.xml');
            if ($clasificacion !== null) {
                $clasificacion->imprimirClasificacionEnTabla();
            }
        ?>
    </div>
</body>
</html>

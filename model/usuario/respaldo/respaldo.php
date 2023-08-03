<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title>RESPALDO BD || SIFER-APP</title>
    <style>

    </style>
    <link rel="shortcut icon" href="../../controller/image/favicon.png" type="image/x-icon">

</head>

<body>

    <div class="modal" tabindex="-1" id="mensajeModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Mensaje</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="mensajeTexto">Este es el mensaje del modal</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <?php

    // Debemos ponerle contraseña al phpMyAdmin ojo hacer respaldo a todas las bases de datos

    $mysqlDatabaseName = 'sifer-app';
    $mysqlUserName = 'root';
    $mysqlPassword = 'lucho2005533';
    $mysqlHostName = 'localhost';
    $mysqlExportPath = 'respaldo.sql';

    // Por favor no haga ningun cambio en los siguientes puntos

    $command = 'mysqldump --opt -h' . $mysqlHostName . ' -u' . $mysqlUserName . ' --password="' . $mysqlPassword . '" ' . $mysqlDatabaseName . ' > ' . $mysqlExportPath;
    exec($command, $output, $worked);

    switch ($worked) {
        case 0:
            $mensaje = 'Estimado usuario, la base de datos de ' . $mysqlDatabaseName . ' se ha almacenado correctamente en la siguiente ruta ' . getcwd() . '/' . $mysqlExportPath;
            break;
        case 1:
            $mensaje = 'Se ha producido un error al exportar la base de datos ' . $mysqlDatabaseName . ' a ' . getcwd() . '/' . $mysqlExportPath;
            break;
        case 2:
            $mensaje = 'Se ha producido un error al exportar la base de datos, compruebe la siguiente información: Nombre de la base de datos: ' . $mysqlDatabaseName . ', Nombre de Usuario MySQL: ' . $mysqlUserName;
            break;
    }
    ?>

    <script>
        // Función para mostrar el modal con el mensaje recibido
        function mostrarModal(mensaje) {
            document.getElementById('mensajeTexto').textContent = mensaje;
            $('#mensajeModal').modal('show');
        }
        
        // Llamar a la función para mostrar el modal con el mensaje obtenido del PHP
        <?php
        if (isset($mensaje)) {
            echo 'mostrarModal("' . $mensaje . '");';
        }
        ?>
    </script>

    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

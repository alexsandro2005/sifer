<?php
// SE DEBE INCLUIR EL ARCHIVO DE CONEXION A LA BASE DE DATOS
require_once("../../database/connection.php");
// VARIABLES QUE CONTIENE LA CLASE CON LOS PARAMETROS DE CONEXION A LA BASE DE DATOS
$database = new Database();
// VARIABLE QUE CONTIENE LA CONEXION A LA BASE DE DATOS SIFER-APP
$connection = $database->conectar();


// CONSULTA SQL PARA INVOCAR TODAS LAS MARCAS REGISTRADAS EN LA BASE DE DATOS
$select_marca = $connection->prepare("SELECT * FROM marcas_motos");
$select_marca->execute();
$marca = $select_marca->fetch(PDO::FETCH_ASSOC);

// CONSULTA SQL PARA INVOCAR LOS TIPOS DE MODELO EN LA BASE DE DATOS
$select_modelo = $connection->prepare("SELECT * FROM modelos");
$select_modelo->execute();
$modelo = $select_modelo->fetch(PDO::FETCH_ASSOC);

// CONSULTA SQL PARA INVOCAR LOS COLORES REGISTRADOS EN LA BASE DE DATOS
$select_color = $connection->prepare("SELECT * FROM colores_moto");
$select_color->execute();
$color = $select_color->fetch(PDO::FETCH_ASSOC);

// CONSULTA SQL PARA INVOCAR LOS TIPOS DE COMBUSTIBLE REGISTRADOS EN LA BASE DE DATOS
$combustible = $connection->prepare("SELECT * FROM combustible");
$combustible->execute();
$sele_combustible = $combustible->fetch(PDO::FETCH_ASSOC);

// CONSULTA SQL PARA INVOCAR LOS TIPOS DE CARROCERIA REGISTRADOS EN LA BASE DE DATOS
$carroceria = $connection->prepare("SELECT * FROM carroceria");
$carroceria->execute();
$sele_carroceria = $carroceria->fetch(PDO::FETCH_ASSOC);

// CONSULTA SQL PARA INVOCAR LOS CILINDRAJES REGISTRADOS EN LA BASE DE DATOS
$cilindraje = $connection->prepare("SELECT * FROM cilindraje");
$cilindraje->execute();
$sele_cilindraje = $cilindraje->fetch(PDO::FETCH_ASSOC);

// CONSULTA SQL PARA INVOCAR LOS TIPOS DE SERVICIOS DE MOTO REGISTRADOS EN LA BASE DE DATOS
$service_moto = $connection->prepare("SELECT * FROM servicio_moto");
$service_moto->execute();
$service = $service_moto->fetch(PDO::FETCH_ASSOC);

// VARIABLE QUE CONTIENE LA PLACA DE LA MOTO PARA REALIZAR ACTUALIZACION A SUS DATOS

$placa = $_GET['placa'];



$moto_update = $connection->prepare("SELECT *  FROM motorcycles INNER JOIN user INNER JOIN modelos INNER JOIN carroceria INNER JOIN cilindraje INNER JOIN colores_moto INNER JOIN combustible INNER JOIN marcas_motos INNER JOIN servicio_moto ON motorcycles.document = user.document AND motorcycles.id_modelo = modelos.id_modelo  AND motorcycles.id_marca = marcas_motos.id AND motorcycles.id_carroceria = carroceria.id_carroceria AND motorcycles.id_cilindraje = cilindraje.id_cilindraje AND motorcycles.id_servicio_moto = servicio_moto.id_servicio_moto AND motorcycles.id_color = colores_moto.id_color AND motorcycles.id_combustible = combustible.id_combustible WHERE motorcycles.placa = '" . $_GET['placa'] . "'");
$moto_update->execute();
$motorcycle = $moto_update->fetch(PDO::FETCH_ASSOC);


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formreg")) {

    // VARIABLES DE ASIGNACION DE VALORES QUE SE ENVIA DEL FORMULARIO REGISTRO DE MOTOS

    $placa_user = $_POST['placa'];
    $km_user = $_POST['km'];
    $color_user = $_POST['color'];
    $moto_combus = $_POST['combustible'];
    $moto_carroceria = $_POST['carroceria'];
    $moto_cilindraje = $_POST['cilindraje'];
    $moto_servicio = $_POST['servicio'];

    $db_validation = $connection->prepare("SELECT * FROM motorcycles WHERE placa='". $_GET['placa'] ."'");
    $db_validation->execute();
    $update_validation = $db_validation->fetchAll();
    if ($update_validation) {
        $moto_actualizacion = $connection->prepare("UPDATE motorcycles SET km = '$km_user', id_color = '$color_user', id_carroceria = '$moto_carroceria', id_combustible = '$moto_combus', id_servicio_moto = '$moto_servicio' WHERE placa = '". $_GET['placa'] ."'");
        $moto_actualizacion->execute();
        echo '<script> alert ("Estimado Usuario, Los cambios fueron realizados correctamente");</script>';
        echo '<script> window.location= "index.php"</script>';

    }
    // CONDICIONAL PARA VALIDAR SI EXISTEN RESULTADOS VACIOS AL MOMENTO DE ENVIAR LA INFORMACION DADA EN EL FORMULARIO

    else if ($placa_user == "" || $km_user == "" || $modelo_user == "" || $marca_user == "" || $color_user == "" || $documento_user == "" || $moto_combus == "" || $moto_carroceria == "" || $moto_servicio == "" || $moto_cilindraje == "") {
        // CONDICIONAL DEPENDIENDO SI EXISTEN ALGUN CAMPO VACIO EN EL FORMULARIO DE LA INTERFAZ
        echo '<script> alert ("Estimado Usuario, Existen Datos Vacios En El Formulario");</script>';
        echo '<script> windows.location= "actualizar_moto.php"</script>';
    } else {
    }
}
?>
<!-- ESTRUCTURA DEL FORMULARIO DE REGISTRO HTML -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <title>ACTUALIZACION DE MOTO || SIFER-APP</title>
    <link rel="stylesheet" href="../../controller/CSS/crear_moto.css">
    <link rel="stylesheet" href="../../controller/CSS/select2.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="../../controller/JS/select2.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../../controller/CSS/icons.css">
    <link rel="shortcut icon" href="../../controller/image/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="../../controller/image/favicon.png" type="image/x-icon">
</head>

<body onload="formreg.placa.focus()">

    <video autoplay loop muted poster="../../controller/image/poster.png">
        <source src="../../controller/image/video_motos.mp4" type="video/mp4">
    </video>

    <!-- FORM CONTAINER -->
    <main>
        <div class="container_title">
            <header>ACTUALIZACION DE MOTO</header>
        </div>
        <form method="POST" name="formreg" action="" autocomplete="off" id="formulario" class="formulario">


            <!-- Container: Placa -->
            <div class="formulario__grupo" id="grupo__placa">
                <label for="username" class="formulario__label">Placa</label>
                <div class="formulario__grupo-input">
                    <input type="text" class="formulario__input" readonly value="<?php echo $_GET['placa'] ?>" name="placa" id="placa" placeholder="Ingrese numero de placa">
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">Debe ingresar la placa de la moto y debe ser de 3 letras y 3 numeros.</p>
            </div>
            <!-- Container: Kilometraje -->
            <div class="formulario__grupo" id="grupo__km">
                <label for="name" class="formulario__label">Kilometraje</label>
                <div class="formulario__grupo-input">
                    <input value="<?php echo $motorcycle['km'] ?>" type="number" class="formulario__input" name="km" required id="km" placeholder="Ingrese sus nombres">
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">Debe ingresar el kilometraje actual de la moto y no debe superar los 7 numeros.</p>
            </div>





            <div class="formulario__grupo select">
                <div class="top">
                    <label for="color" class="formulario__label label">Color</label>
                    <a class="crear" href="crear_color.php">+ Crear</a>
                </div>
                <div class="formulario__grupo__input">
                    <select id="buscador" name="color" class="formulario__input">
                        <option value="<?php echo $motorcycle ['id_color']?>">Es de color <?php echo $motorcycle ['nombre_color']?>  </option>
                        <?php
                        do {
                        ?>
                            <option value="<?php echo ($color['id_color']) ?>"><?php echo ($color['nombre_color']) ?></option>
                        <?php
                        } while ($color = $select_color->fetch(PDO::FETCH_ASSOC));
                        ?>
                    </select>
                </div>
            </div>
            <div class="formulario__grupo select">
                <div class="top">
                    <label for="combustible" class="formulario__label label">Combustible</label>
                    <a class="crear" href="crear_combustible.php">+ Crear</a>
                </div>
                <div class="formulario__grupo__input">
                    <select id="combustible" name="combustible" class="formulario__input">
                        <option value="<?php echo $motorcycle ['id_combustible']?>">la moto utiliza <?php echo $motorcycle ['combustible']?></option>
                        <?php
                        do {
                        ?>
                            <option value="<?php echo ($sele_combustible['id_combustible']) ?>"><?php echo ($sele_combustible['combustible']) ?></option>


                        <?php
                        } while ($sele_combustible = $combustible->fetch(PDO::FETCH_ASSOC));
                        ?>
                    </select>

                </div>
            </div>

            <div class="formulario__grupo select">
                <div class="top">
                    <label for="Carroceria" class="formulario__label label">Carroceria</label>
                    <a class="crear" href="carroceria.php">+ Crear</a>
                </div>
                <div class="formulario__grupo__input">
                    <select id="carroceria" name="carroceria" class="formulario__input">
                        <option value="<?php echo $motorcycle['id_carroceria']?>">Seleccione nuevo Tipo de Carroceria</option>
                        <?php
                        do {
                        ?>
                            <option value="<?php echo ($sele_carroceria['id_carroceria']) ?>"><?php echo ($sele_carroceria['carroceria']) ?></option>


                        <?php
                        } while ($sele_carroceria = $carroceria->fetch(PDO::FETCH_ASSOC));
                        ?>
                    </select>

                </div>
            </div>


            <div class="formulario__grupo select">
                <div class="top">
                    <label for="Cilindraje" class="formulario__label label">Cilindraje</label>
                    <a class="crear" href="crear_cilindraje.php">+ Crear</a>
                </div>
                <div class="formulario__grupo__input">
                    <select id="cilindraje" name="cilindraje" class="formulario__input">
                        <option value="<?php echo $motorcycle ['id_cilindraje'] ?>">Seleccione Tipo de Cilindraje</option>
                        <?php
                        do {
                        ?>
                            <option value="<?php echo ($sele_cilindraje['id_cilindraje']) ?>"><?php echo ($sele_cilindraje['cilindraje']) ?></option>


                        <?php
                        } while ($sele_cilindraje = $cilindraje->fetch(PDO::FETCH_ASSOC));
                        ?>
                    </select>

                </div>
            </div>

            <div class="formulario__grupo select">
                <div class="top">
                    <label for="servicio" class="formulario__label label">Servicio de Moto</label>
                    <a class="crear" href="servicio_moto.php">+ Crear</a>
                </div>
                <div class="formulario__grupo__input">
                    <select id="servicio" name="servicio" class="formulario__input">
                        <option value="<?php echo $motorcycle ['id_servicio_moto']?>">Seleccione Tipo de Servicio Moto</option>
                        <?php
                        do {
                        ?>
                            <option value="<?php echo ($service['id_servicio_moto']) ?>"><?php echo ($service['servicio_moto']) ?></option>


                        <?php
                        } while ($service = $service_moto->fetch(PDO::FETCH_ASSOC));
                        ?>
                    </select>

                </div>
            </div>



            <!-- Container: Numero de documento -->
            <div class="state">
                <input class="cajas" readonly type="hidden" value="<?php echo $documento ?>" name="documento" placeholder="Ingrese su numero de documento">
            </div>


            <div class="formulario__grupo formulario__grupo-btn-enviar">
                <input type="submit" name="validar" value="Actualizar" class="formulario__btn"></input>
                <input type="hidden" name="MM_insert" value="formreg">
                <a href="index.php" class="return">Regresar</a>
                <!-- <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p> -->
            </div>
        </form>
    </main>


    <!-- BUSCADORES EN TIEMPO REAL DEL SELECT AL CUAL FUE ASIGNADO CON EL ID UNICO -->

    <script>
        $('#buscador').select2();
    </script>
    <!-- BUSCADORES EN TIEMPO REAL DEL SELECT AL CUAL FUE ASIGNADO CON EL ID UNICO -->

    <script>
        $('#controlbuscador').select2();
    </script>

    <!-- BUSCADORES EN TIEMPO REAL DEL SELECT AL CUAL FUE ASIGNADO CON EL ID UNICO -->

    <script>
        $('#control').select2();
    </script>

    <!-- BUSCADORES EN TIEMPO REAL DEL SELECT AL CUAL FUE ASIGNADO CON EL ID UNICO -->

    <script>
        $('#combustible').select2();
    </script>

    <!-- BUSCADORES EN TIEMPO REAL DEL SELECT AL CUAL FUE ASIGNADO CON EL ID UNICO -->

    <script>
        $('#carroceria').select2();
    </script>

    <!-- BUSCADORES EN TIEMPO REAL DEL SELECT AL CUAL FUE ASIGNADO CON EL ID UNICO -->

    <script>
        $('#cilindraje').select2();
    </script>

    <!-- BUSCADORES EN TIEMPO REAL DEL SELECT AL CUAL FUE ASIGNADO CON EL ID UNICO -->

    <script>
        $('#servicio').select2();
    </script>

    <script src="../../controller/JS/motos.js"></script>
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>

</body>

</html>
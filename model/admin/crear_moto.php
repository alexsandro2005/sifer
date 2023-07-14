<?php
// SE DEBE INCLUIR EL ARCHIVO DE CONEXION A LA BASE DE DATOS
require_once("../../database/connection.php");
// VARIABLES QUE CONTIENE LA CLASE CON LOS PARAMETROS DE CONEXION A LA BASE DE DATOS
$database = new Database();
// VARIABLE QUE CONTIENE LA CONEXION A LA BASE DE DATOS SIFER-APP
$connection = $database->conectar();

// SE HACE ENVIO DEL NUMERO DE DOCUMENTO POR EL METODO GET Y SE LE ASIGNA ESE VALOR A OTRA VARIABLE
$documento= $_GET['documento'];

// CONSULTA SQL PARA INVOCAR LAS MARCAS REGISTRADAS EN LA BASE DE DATOS
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


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formreg")) {

    // VARIABLES DE ASIGNACION DE VALORES QUE SE ENVIA DEL FORMULARIO REGISTRO DE MOTOS


    $placa_user = $_POST['placa'];
    $km_user = $_POST['km'];
    $barcode = $_POST['barcode'];
    $modelo_user = $_POST['modelo'];
    $marca_user = $_POST['marca'];
    $color_user = $_POST['color'];
    $documento_user = $_POST['document'];
    $moto_combus = $_POST['combustible'];
    $moto_carroceria = $_POST['carroceria'];
    $moto_cilindraje = $_POST['cilindraje'];
    $moto_servicio = $_POST['servicio'];

    // CONSULTA SQL PARA VERIFICAR SI EL USUARIO YA EXISTE EN LA BASE DE DATOS
    $db_validation = $connection->prepare("SELECT * FROM motorcycles WHERE placa='$placa_user'");
    $db_validation->execute();
    $register_validation = $db_validation->fetchAll();

    // CONDICIONALES DEPENDIENDO EL RESULTADO DE LA CONSULTA
    if ($register_validation) {
        // SI SE CUMPLE LA CONSULTA ES PORQUE EL USUARIO YA EXISTE
        echo '<script> alert ("// Estimado Usuario, los datos ingresados ya se encuentran registrados //");</script>';
        echo '<script> window.location= "crear_moto.php"</script>';
    } else if ($barcode == "" || $placa_user == "" || $km_user == "" || $modelo_user == "" || $marca_user == "" || $color_user == "" || $documento_user == "" || $moto_combus == "" || $moto_carroceria == "" || $moto_servicio == "" || $moto_cilindraje == "") {
        // CONDICIONAL DEPENDIENDO SI EXISTEN ALGUN CAMPO VACIO EN EL FORMULARIO DE LA INTERFAZ
        echo '<script> alert ("Estimado Usuario, Existen Datos Vacios En El Formulario");</script>';
        echo '<script> windows.location= "crear_moto.php"</script>';
    } else {
        $register_user = $connection->prepare("INSERT INTO motorcycles(placa,barcode,km,id_modelo,id_marca,id_color,id_carroceria,id_cilindraje,id_combustible,id_servicio_moto,document)VALUES('$placa_user','$barcode', '$km_user', '$modelo_user', '$marca_user','$color_user','$moto_carroceria','$moto_cilindraje','$moto_combus','$moto_servicio', '$documento_user')");
        if ($register_user->execute()) {
            echo '<script>alert ("Registro de moto Exitoso");</script>';
            echo '<script>window.location="index.php"</script>';
        }
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
    <title>REGISTRO DE MOTO || SIFER-APP</title>
    <link rel="stylesheet" href="../../controller/CSS/crear_moto.css">
    <link rel="stylesheet" href="../../controller/CSS/select2.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="../../controller/JS/select2.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../../controller/CSS/icons.css">
    <link rel="shortcut icon" href="../../controller/image/favicon.png" type="image/x-icon">


</head>

<body onload="formreg.placa.focus()">

    <video autoplay loop muted poster="../../controller/image/poster.png">
        <source src="../../controller/image/video_motos.mp4" type="video/mp4">
    </video>

    <!-- FORM CONTAINER -->
    <main>
        <div class="container_title">
            <header>CREAR MOTO</header>
        </div>
        <form method="POST" name="formreg" action="" autocomplete="off" id="formulario" class="formulario">

            <!-- Container: Documento -->

            <div class="formulario__grupo" id="grupo__documento">
                <label for="username" class="formulario__label">Documento Propietario</label>
                <div class="formulario__grupo-input">
                    <input type="number" readonly maxlength="10" value="<?php echo $documento?>" class="formulario__input" name="document" required id="document">
                </div>
            </div>

            <!-- Container: Placa -->
            <div class="formulario__grupo" id="grupo__placa">
                <label for="username" class="formulario__label">Placa</label>
                <div class="formulario__grupo-input">
                    <input type="text" maxlength="6" oninput="mayusculas();" class="formulario__input" name="placa" required id="placa" placeholder="Ingrese numero de placa">
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">Debe ingresar la placa de la moto y debe ser de 4 letras y 2 numeros.</p>
            </div>

            <!-- Container: Codigo de Barras -->
            <div class="formulario__grupo" id="grupo__barcode">
                <label for="username" class="formulario__label">Codigo de Barras</label>
                <div class="formulario__grupo-input">
                    <input type="number" oninput="maxlengthNumber(this);" maxlength="10" class="formulario__input" name="barcode" required id="barcode" placeholder="Ingrese numero de placa">
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">Debe ingresar el codigo de barras que se le asignara a la moto como identificacion unica.</p>
            </div>

            <!-- Container: Kilometraje -->
            <div class="formulario__grupo" id="grupo__km">
                <label for="name" class="formulario__label">Kilometraje</label>
                <div class="formulario__grupo-input">
                    <input type="number" maxlength="6" oninput="maxlengthNumber(this);" class="formulario__input" name="km" required id="km" placeholder="Ingrese sus nombres">
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">Debe ingresar el kilometraje actual de la moto y no debe superar los 7 numeros.</p>
            </div>

            <div class="formulario__grupo select">
                <div class="top">
                    <label for="tipousuario" class="formulario__label label">Marca</label>
                    <a class="crear" href="crear_marca.php">+ Crear</a>
                </div>
                <div class="formulario__grupo__input">
                    <select id="control" name="marca" class="formulario__input">
                        <option value="">Seleccione Marca</option>

                        <?php
                        do {
                        ?>
                            <option value="<?php echo ($marca['id']) ?>"><?php echo ($marca['nombre']) ?></option>


                        <?php
                        } while ($marca = $select_marca->fetch(PDO::FETCH_ASSOC));
                        ?>
                    </select>
                </div>
            </div>

            <div class="formulario__grupo select">
                <div class="top">
                    <label for="tipousuario" class="formulario__label label">Modelo</label>
                    <a class="crear" href="crear_modelo.php">+ Crear </a>
                </div>
                <div class="formulario__grupo__input">
                    <select id="controlbuscador" name="modelo" class="formulario__input">

                        <option value="">Seleccione Modelo</option>

                        <?php
                        do {
                        ?>

                            <option value="<?php echo ($modelo['id_modelo']) ?>"><?php echo ($modelo['modelo_año']) ?></option>

                        <?php
                        } while ($modelo = $select_modelo->fetch(PDO::FETCH_ASSOC));
                        ?>
                    </select>
                </div>
            </div>


            <div class="formulario__grupo select">
                <div class="top">
                    <label for="color" class="formulario__label label">Color</label>
                    <a class="crear" href="crear_color.php">+ Crear</a>
                </div>
                <div class="formulario__grupo__input">
                    <select id="buscador" name="color" class="formulario__input">
                        <option value="">Seleccione Color</option>
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
                        <option value="">Seleccione Tipo de Combustible</option>
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
                        <option value="">Seleccione Tipo de Carrociera</option>
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
                        <option value="">Seleccione Tipo de Cilindraje</option>
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
                        <option value="">Seleccione Tipo de Servicio Moto</option>
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

            <div class="formulario__grupo formulario__grupo-btn-enviar">
                <input type="submit" name="validar" value="Crear Moto" class="formulario__btn"></input>
                <input type="hidden" name="MM_insert" value="formreg">
                <a href="lista_clientes.php" class="return">Regresar</a>

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

    <script>
        function mayusculas() {
            let input = document.getElementById("placa");
            input.value = input.value.toUpperCase();
        }
    </script>
    <script>
        function mayusculas() {
            let input = document.getElementById("placa");
            input.value = input.value.toUpperCase();
        }
    </script>

    <!-- FUNCION DE JAVASCRIPT QUE PERMITE INGRESAR SOLO EL NUMERO VALORES REQUERIDOS DE ACUERDO A LA LONGITUD MAXLENGTH DEL CAMPO -->

    <script>
        function maxlengthNumber(obj) {

            if (obj.value.length > obj.maxLength) {
                obj.value = obj.value.slice(0, obj.maxLength);
                alert("Debe ingresar solo el numeros de digitos requeridos");
            }
        }
    </script>

    <script>
        function maxcelNumber(obj) {

            if (obj.value.length > obj.maxLength) {
                obj.value = obj.value.slice(0, obj.maxLength);
                alert("Debe ingresar solo 10 numeros.");
            }
        }
    </script>
    <!-- FUNCION DE JAVASCRIPT QUE PERMITE INGRESAR SOLO LETRAS -->

    <script>
        function multipletext(e) {
            key = e.keyCode || e.which;

            teclado = String.fromCharCode(key).toLowerCase();

            letras = "qwertyuiopasdfghjklñzxcvbnm";

            especiales = "8-37-38-46-164-46";

            teclado_especial = false;

            for (var i in especiales) {
                if (key == especiales[i]) {
                    teclado_especial = true;
                    alert("Debe ingresar solo letras y espacios en el campo");

                    break;
                }
            }

            if (letras.indexOf(teclado) == -1 && !teclado_especial) {
                return false;
                alert("Debe ingresar solo letras y espacios en el campo");
            }
        }
    </script>



    <script src="../../controller/JS/motos.js"></script>
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>

</body>

</html>
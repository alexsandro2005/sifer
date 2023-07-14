<?php

session_start();
require_once("../../database/connection.php");
$db = new Database();
$connection = $db->conectar();
?>

<?php
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formreg")) {

    // DECLARACION DE LOS VALORES DE LAS VARIABLES DEPENDIENDO DEL TIPO DE CAMPO QUE TENGA EN EL FORMULARIO
    $id_color = $_POST['id_color'];
    $nombre_color = $_POST['nombre_color'];


    $examinar = $connection->prepare("SELECT * FROM colores_moto WHERE id_color='$id_color' OR nombre_color='$nombre_color' ");
    $examinar->execute();
    $register_validation = $examinar->fetchAll();

    // CONDICIONALES DEPENDIENDO EL RESULTADO DE LA CONSULTA
    if ($register_validation) {
        // SI SE CUMPLE LA CONSULTA ES PORQUE EL USUARIO YA EXISTE
        echo '<script> alert ("// El color ingresado ya se encuentra registrado //");</script>';
        echo '<script> window.location= "crear_color.php"</script>';
    } else if ($id_color == "" || $nombre_color == "") {
        // CONDICIONAL DEPENDIENDO SI EXISTEN ALGUN CAMPO VACIO EN EL FORMULARIO DE LA INTERFAZ
        echo '<script> alert ("// estimado usuario existen datos vacios //");</script>';
        echo '<script> window.location= "crear_color.php"</script>';
    } else {
        $register_user = $connection->prepare("INSERT INTO colores_moto(id_color,nombre_color) VALUES ('$id_color','$nombre_color')");
        if ($register_user->execute()) {
            echo '<script>alert("// Estimado Usuario el registro del nuevo color de moto ha sido exitoso. //");</script>';
            echo '<script>window.location="index.php"</script>';
        }
    }
}



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <title>CREAR COLOR || SIFER- APP</title>
    <link rel="shortcut icon" href="../../controller/image/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../controller/CSS/crear.css">
    <link rel="shortcut icon" href="controller/image/SENA.png" type="image/x-icon">
</head>

<body>


    <video autoplay loop muted poster="../../controller/image/motos_img.png">
        <source src="../../controller/image/video_motos.mp4" type="video/mp4">
    </video>

    <!-- FORM CONTAINER -->

    <main>
        <div class="container_title">
            <header>CREAR COLOR DE MOTO</header>
        </div>
        <form method="POST" name="formreg" action="" autocomplete="off" id="formulario" class="formulario">

            <!-- Container: Id_Color -->
            <div class="formulario__grupo" id="grupo__id">
                <label for="document" class="formulario__label">Codigo de color</label>
                <div class="formulario__grupo-input">
                    <input type="number" autofocus maxlength="5" oninput="maxlengthNumber(this);"  class="formulario__input" name="id_color" id="id" required placeholder="Ingrese el codigo unico del color">
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">Debe ingresar solo 5 numeros.</p>
            </div>

            <!-- Container: Color -->
            <div class="formulario__grupo" id="grupo__categoria">
                <label for="document" class="formulario__label">Nuevo color</label>
                <div class="formulario__grupo-input">
                    <input type="text" maxlength="20" oninput="maxlengthNumber(this);" onkeypress="return(multipletext(event));" class="formulario__input" name="nombre_color" id="categoria" required placeholder="Ingrese el codigo del modelo">
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">Debe ingresar solo letras y espacios, maximo 20 letras. </p>
            </div>


            <div class="formulario__grupo formulario__grupo-btn-enviar">
                <input type="submit" name="validar" value="Crear Color" class="formulario__btn"></input>
                <input type="hidden" name="MM_insert" value="formreg">
                <a href="index.php" class="return">Regresar</a>
                <!-- <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p> -->
            </div>
        </form>
    </main>

    <script>
        function maxlengthNumber(obj){

            if(obj.value.length > obj.maxLength){
                obj.value = obj.value.slice(0, obj.maxLength);
                alert("Debe ingresar solo el numeros de digitos requeridos");              
            }
        }
    </script>

    <script>
        function maxcelNumber(obj){

            if(obj.value.length > obj.maxLength){
                obj.value = obj.value.slice(0, obj.maxLength);
                alert("Debe ingresar solo 10 numeros.");              
            }
        }
    </script>
    <!-- FUNCION DE JAVASCRIPT QUE PERMITE INGRESAR SOLO LETRAS -->

    <script>
        function multipletext(e) {
            key=e.keyCode || e.which;

            teclado=String.fromCharCode(key).toLowerCase();

            letras="q wertyuiopasdfghjklñzxcvbnm";

            especiales="8-37-38-46-164-46";

            teclado_especial=false;

            for(var i in especiales){
                if(key==especiales[i]){
                    teclado_especial=true;
                    alert ("Debe ingresar solo letras y espacios en el campo"); 

                    break;
                }
            }

            if(letras.indexOf(teclado)==-1 && !teclado_especial){
                return false;
                alert ("Debe ingresar solo letras y espacios en el campo"); 
            }
        }
    </script>

    <script src="../../controller/JS/crear.js"></script>
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>

</body>

</html>
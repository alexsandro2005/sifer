<?php

    session_start();
    require_once("../../database/connection.php");
    $db = new Database();
    $connection = $db->conectar();
?>

<?php
    if((isset($_POST["MM_insert"]))&&($_POST["MM_insert"]=="formreg"))

    {
        // DECLARACION DE LOS VALORES DE LAS VARIABLES DEPENDIENDO DEL TIPO DE CAMPO QUE TENGA EN EL FORMULARIO
        $id_modelos = $_POST['id_modelo'];
        $modelos = $_POST['modelo'];


        $examinar=$connection ->prepare("SELECT * FROM modelos WHERE id_modelo='$id_modelos' OR modelo_año='$modelos'");
        $examinar -> execute();
        $register_validation=$examinar->fetchAll();

        // CONDICIONALES DEPENDIENDO EL RESULTADO DE LA CONSULTA
        if ($register_validation){

            // SI SE CUMPLE LA CONSULTA ES PORQUE EL USUARIO YA EXISTE

            echo '<script> alert ("//Estimado Usuario, el modelo ya se encuentra registrado //");</script>';
            echo '<script> window.location= "crear_modelo.php"</script>';
        }
        else if ($id_modelos == "" ||$modelos=="")
        {
            // CONDICIONAL DEPENDIENDO SI EXISTEN ALGUN CAMPO VACIO EN EL FORMULARIO DE LA INTERFAZ
            echo '<script> alert (" //Estimado usuario existen datos vacios. //");</script>';
            echo '<script> window.location= "crear_modelo.php"</script>';
        }else
        {
            // DECISION QUE PERMITE REALIZAR EL ENVIO DE LA INFORMACION MEDIANTE LA BASE DE DATOS //
            $register_user=$connection->prepare("INSERT INTO modelos(id_modelo,modelo_año) VALUES ('$id_modelos','$modelos')");
            $register_user->execute();
            echo '<script>alert("// Estimado Usuario el registro del nuevo modelo ha sido exitoso. //");</script>';
            echo '<script>window.location="index.php"</script>';
        

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
    <title>CREAR MODELO || SIFER-APP</title>
    <link rel="shortcut icon" href="../../controller/image/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../controller/CSS/crear.css">
    <link rel="shortcut icon" href="controller/image/SENA.png" type="image/x-icon">
</head>
<body onload="formreg.id_modelos.focus()">


    <video autoplay loop muted poster="../../controller/image/motos_img.png" > <source src="../../controller/image/video_motos.mp4" type="video/mp4"></video> 

    <!-- FORM CONTAINER -->
    <main>
        <div class="container_title">
            <header>CREAR MODELO</header>
        </div>
        <form method="POST" name="formreg" action="" autocomplete="off" id="formulario" class="formulario">

            <!-- Container: Document -->
			<div class="formulario__grupo" id="grupo__id">
				<label for="document" class="formulario__label">Codigo de modelo</label>
				<div class="formulario__grupo-input">
					<input autofocus type="number"  maxlength="5" oninput="maxlengthNumber(this);" class="formulario__input" name="id_modelo" id="id" required placeholder="Ingrese el codigo del modelo">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El codigo de modelo debe contener solo 3 numeros</p>
			</div>

            <!-- Container: Username -->
			<div class="formulario__grupo" id="grupo__modelos">
				<label for="username" class="formulario__label">Nuevo Modelo</label>
				<div class="formulario__grupo-input">
					<input type="number" class="formulario__input" maxlength="4" oninput="maxlengthNumber(this)" name="modelo" required id="modelos" placeholder="Ingrese el nuevo modelo">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El nuevo modelo debe contener solo 4 numeros</p>
			</div>

            <div class="formulario__grupo formulario__grupo-btn-enviar">
				<input type="submit" name="validar" value="Crear Modelo" class="formulario__btn"></input>
                <input type="hidden" name="MM_insert" value="formreg">
                <a href="index.php" class="return">Regresar</a>
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



<?php
    session_start();
    require_once("../../database/connection.php");
    $db = new Database();
    $connection = $db->conectar();


?>
<?php
    $control=$connection->prepare ("SELECT * FROM type_user");
    $control->execute();
    $fila=$control->fetch(PDO::FETCH_ASSOC);

    $select_gender=$connection->prepare("SELECT * FROM gender");
    $select_gender->execute();
    $gender=$select_gender->fetch(PDO::FETCH_ASSOC);
?>
<?php

    $select_state=$connection ->prepare ("SELECT * from state");
    $select_state -> execute();
    $state_update=$select_state -> fetch(PDO::FETCH_ASSOC);


?>



<?php
   $register_update=$connection ->prepare("SELECT * FROM services WHERE id_services = '".$_GET['id_services']."'");
   $register_update-> execute();
   $fiels = $register_update -> fetch(PDO::FETCH_ASSOC);

?>


<?php
    if((isset($_POST["MM_insert"]))&&($_POST["MM_insert"]=="formreg"))

    {
        // DECLARACION DE LOS VALORES DE LAS VARIABLES DEPENDIENDO DEL TIPO DE CAMPO QUE TENGA EN EL FORMULARIO
        $encriptaciones=[
            'cost'=> 15
        ];

        $servi = $_POST['id_services'];
        $ser = $_POST['service'];
        $costo = $_POST['costo_service'];
   

        // CONSULTA SQL PARA VERIFICAR SI EL USUARIO YA EXISTE EN LA BASE DE DATOS
        $examinar=$connection ->prepare("SELECT * FROM services WHERE service= '$ser'");
        $examinar -> execute();
        $register_validation=$examinar->fetchAll(PDO::FETCH_ASSOC);

        // CONDICIONALES DEPENDIENDO EL RESULTADO DE LA CONSULTA
        if ($register_validation){

            // SI SE CUMPLE LA CONSULTA ES PORQUE EL USUARIO YA EXISTE

            echo '<script> alert ("// DOCUMENTO O USUARIO NO EXISTEN, CAMBIELOS //");</script>';
            echo '<script> windows.location= "register_usu.php"</script>';

        }else
        {
            
            $actu_update = $connection -> prepare ( "UPDATE services SET service='$ser', costo_service='$costo' WHERE id_services = '".$_GET['id_services']."'");
            $actu_update->execute();
                echo '<script>alert ("Actualizacion Exitosa, Gracias");</script>';
                echo '<script>window.location="./lista_servicios.php"</script>';



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
    <title>REGISTRO DE USUARIO || SENA</title>
    <link rel="shortcut icon" href="../../controller/image/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../controller/CSS/crear_service.css">
    <link rel="shortcut icon" href="../../controller/image/SENA.png" type="image/x-icon">
</head>
<body onload="formreg.document.focus()">

    <video autoplay loop muted poster="../../controller/image/poster.png" > <source src="../../controller/image/video_motos.mp4" type="video/mp4"></video>
    <main>
        <div class="container_title">
            <header>ACTUALIZACION DE SERVICIO</header>
        </div>
        <form method="POST" name="formreg" action="" autocomplete="off" id="formulario" class="formulario">

            <!-- Group: Document -->
            <div class="formulario__grupo" id="grupo__service">
				<label for="service" class="formulario__label">Nombre servicio</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" readonly name="service" required id="service" value="<?php echo $fiels['code_service']?>" placeholder="Ingrese sus nombres">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">Debe ingresar su nombre completo, o en preferencia su primer nombre y apellido.</p>
			</div>

            <!-- Group: Nombre -->
			<div class="formulario__grupo" id="grupo__service">
				<label for="service" class="formulario__label">Nombrel servicio</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" readonly name="service" required id="service" value="<?php echo $fiels['service']?>" placeholder="Ingrese sus nombres">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">Debe ingresar su nombre completo, o en preferencia su primer nombre y apellido.</p>
			</div>


            <!-- Group: Username -->
			<div class="formulario__grupo" id="grupo__costo_service">
				<label for="costo_service" class="formulario__label">costo del servicio</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="costo_service"value="<?php echo $fiels['costo_service']?>" required id="costo_service" placeholder="Ingrese su nombre">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El usuario tiene que ser de 4 a 10 dígitos y solo puede contener numeros, letras y guion bajo.</p>
			</div>


            
            <!-- Group: Confirmacion de formulario  -->

            <div class="formulario__mensaje" id="formulario__mensaje">
				<!-- <p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p> -->
			</div>

            <div class="formulario__grupo formulario__grupo-btn-enviar" style="padding-top:60px;">
				<input type="submit" name="validar" value="Actualizar" class="formulario__btn"></input>
                <input type="hidden" name="MM_insert" value="formreg">
                <a href="index.php" class="return">Regresar</a>
				<!-- <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p> -->
			</div>
        </form>
    </main>

    <script src="../../controller/JS/formulario.js"></script>
	<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>

</body>
</html>
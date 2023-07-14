<?php
    session_start();
    require_once("../database/connection.php");
    $db = new Database();
    $con = $db->conectar();

?>
<?php

if ((isset ($_POST["MM_update"])) && ($_POST["MM_update"] =="form2"))

{

        // DECLARACION DE LOS VALORES DE LAS VARIABLES DEPENDIENDO DEL TIPO DE CAMPO QUE TENGA EN EL FORMULARIO
        $encriptaciones=[
            'cost'=> 15
        ];
        $contra = password_hash($_POST['password'], PASSWORD_DEFAULT, $encriptaciones) ;

        if ($_POST['password']== "" )
        {
            echo '<script>alert("datos vacios no ingreso la clave");</script>';
            echo '<script>window.location="recuperar_contrasena.php"</script>';
        }
        else{

            $document= $_SESSION['id_user'];
            
            $actu_update = $con -> prepare ( "UPDATE user  SET password = '$contra' WHERE document='$document'");
            $actu_update->execute();
            $update=$actu_update->fetch(PDO::FETCH_ASSOC);
            echo '<script>alert ("Cambio de contraseña exitoso, puede iniciar sesion.");</script>';
            echo '<script>window.location="../index.php"</script>';

        }
}
?>

<?php
if (isset( $_POST["inicio"]))
{   
    // Esta linea me sirve para imprimir el valor que recibe la variable cuando el usuario digita en el fomulario
    $documento=$_POST["document"];
    $username=$_POST["username"];
    // Estas lineas sirven para realizar la consulta a la base de datos
    $sql=$con ->prepare("SELECT * FROM user WHERE document = '$documento' AND username='$username'");
    $sql -> execute();
    // Esta linea almacena la consulta a la base datos
    $fila=$sql -> fetch(PDO::FETCH_ASSOC);

    if($fila)
    {
        // Esta linea sirve para mirar la consulta al archivo donde se encuentra la variable  $fila
        $_SESSION['id_user']=$fila['document'];
    }

    else
    {
    echo '<script> alert ("Estimado usuario el documento o nombre de usuario se valida como no registrado.")</script>';
    echo '<script> window.location="cambiar_contrasena.php"</script>';
    }


}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAMBIO DE CONTRASEÑA|| SIFER-APP</title>
    <link rel="stylesheet" href="../controller/CSS/login_style.css">
    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
    <link rel="shortcut icon" href="../controller/image/favicon.png" type="image/x-icon">
</head>

<body>

    <video autoplay loop muted poster="../controller/image/motos_img.png">
        <source src="../controller/image/video_motos.mp4">
    </video>

    <div class="container_all">
        <div class="ctn-form">
            <header>
                <img src="../controller/image/favicon.png" alt="" class="logo">
                <h1 class="title"> <span>NUEVO CAMBIO DE CONTRASEÑA</span></h1>
            </header>

            <form action="../controller/recuperar_contrasena.php" method="POST" autocomplete="off" id="formulario" class="formulario" autocomplete="off">

                <!-- Group: password -->
                <div class="formulario__grupo" id="grupo__password">
                    <label for="document" class="formulario__label">Nueva Contraseña</label>
                    <div class="formulario__grupo-input">
                        <input type="password" autofocus onkeypress="" maxlength="12" oninput="maxlengthNumber(this);" class="formulario__input" name="password" id="password" required placeholder="Ingrese su nueva contraseña">
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">La contraseña debe ser de 10 a 12 digitos y pueden tener letras, numeros y guiones bajos.</p>
                </div>
                <!-- Group: password2 -->

                <div class="formulario__grupo" id="grupo__password2">
                    <label for="username" class="formulario__label">Confirmar Contraseña</label>
                    <div class="formulario__grupo-input">
                        <input type="password" maxlength="12" oninput="maxlengthNumber(this);" class="formulario__input" name="password2" required id="password2" placeholder="Confirme su nueva contraseña">
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">Ambas contraseñas deben ser iguales para realizar el respectivo cambio de contraseña.</p>
                </div>

                <input type="submit" name="validar" value="Cambiar contraseña"></input>
                <input type="hidden" name="MM_update" value="form2">

            </form>
            <span class="text-footer"><a href="../index.php">Regresar a Pagina Principal</a></span>
            <span class="text-footer">¿Aun no se encuentra registrado?<a href="../register_usu.php"> Registrarme</a></span>


        </div>
        <div class="ctn-text">
            <div class="capa"></div>
            <h1 class="title-description">Existencia de <span class="multiple-text"></span><span class="usuario"></h1>
            <p class="textdescription">Lo que más quieres en el mundo tiene nombre, placa y cilindraje, son parte de nuestro día a día, ningún cuidado es suficiente para demostrarle cuánto las amamos, por eso somos tu mejor eleccion.</p>
        </div>
    </div>

    <!-- FUNCION QUE PERMITE INGRESAR SOLO EL NUMERO REQUERIDOS DE VALORES DE ACUERDO AL VALOR DEL MAXLENGTH DEL INPUT -->

    <script>
        function maxlengthNumber(obj) {
            if (obj.value.length > obj.maxLength) {
                obj.value = obj.value.slice(0, obj.maxLength);
                alert("Debe ingresar solo numeros en el campo y debe ser en un rango de 6 a 10 numeros.");
            }
        }
    </script>

    <!-- FUNCION QUE PERMITE INGRESAR SOLO LETRAS EN CADA UNO DE LOS CAMPOS EL CUAL SE INVOCO LA FUNCION EN EL ONKEYPRESS -->

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
                    break;
                }
            }

            if (letras.indexOf(teclado) == -1 && !teclado_especial) {
                return false;
                alert("Debe ingresar solo numeros en el campo y debe ser en un rango de 6 a 10 numeros.");
            }
        }
    </script>

    <!-- TYPED JS -->
    <script src="https://unpkg.com/typed.js@2.0.132/dist/typed.umd.js"></script>
    <script src="../controller/JS/main.js"></script>

    <!-- VALIDACION DE FORMULARIO -->
    <script src="../controller/JS//formulario.js"></script>
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
</body>

</html>

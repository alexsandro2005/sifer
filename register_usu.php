<?php
// SE DEBE INCLUIR EL ARCHIVO DE CONEXION A LA BASE DE DATOS
require_once("database/connection.php");
// VARIABLES QUE CONTIENE LA CLASE CON LOS PARAMETROS DE CONEXION A LA BASE DE DATOS
$database = new Database();
// VARIABLE QUE CONTIENE LA CONEXION A LA BASE DE DATOS SIFER-APP
$connection = $database->conectar();
// CONSULTA SQL PARA INVOCAR LOS TIPOS DE USUARIO REGISTRADOS

// CONSULTA SQL PARA INVOCAR LOS TIPOS DE GENERO
$select_gender = $connection->prepare("SELECT * FROM gender");
$select_gender->execute();
// VARIABLE QUE CONTIENE LA CONSULTA JUNTO CON EL ARRAY ASOCIATIVO QUE CONTIENE LAS FILAS REGISTRADAS
$gender = $select_gender->fetch(PDO::FETCH_ASSOC);
?>
<?php
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formreg")) {

    // VARIABLES QUE CONTIENE EL NUMERO DE ENCRIPTACIONES DE LAS CONTRASEÑAS
    $pass_encriptaciones = [
        'cost' => 15
    ];

    // DECLARACION DE LOS VALORES DE LAS VARIABLES DEPENDIENDO DEL TIPO DE CAMPO QUE TENGA EN EL FORMULARIO
    $document_user = $_POST['document'];
    $name_user = $_POST['name'];
    $surname = $_POST['surname'];
    $username = $_POST['username'];
    $user_password = password_hash($_POST['password'], PASSWORD_DEFAULT, $pass_encriptaciones);
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $type_user = $_POST['id_type_user'];
    $id_gender = $_POST['id_gender'];
    $datetime = $_POST['datetime'];
    $id_state = $_POST['id_state'];
    $checkbox = $_POST['terminos'];

    // CONSULTA SQL PARA VERIFICAR SI EL USUARIO YA EXISTE EN LA BASE DE DATOS
    $db_validation = $connection->prepare("SELECT * FROM user WHERE document='$document_user' OR username='$username'");
    $db_validation->execute();
    $register_validation = $db_validation->fetchAll();

    // CONDICIONALES DEPENDIENDO EL RESULTADO DE LA CONSULTA
    if ($register_validation) {
        // SI SE CUMPLE LA CONSULTA ES PORQUE EL USUARIO YA EXISTE
        echo '<script> alert ("// Estimado Usuario, los datos ingresados ya se encuentran registrados. //");</script>';
        echo '<script> window.location= "register_usu.php"</script>';
    } else if ($document_user == "" || $name_user == "" || $surname == ""  || $username == "" || $user_password == "" || $telephone == "" || $email == "" || $type_user == "" || $id_gender == "" || $datetime == "" || $checkbox == ""  || $id_state == "") {
        // CONDICIONAL DEPENDIENDO SI EXISTEN ALGUN CAMPO VACIO EN EL FORMULARIO DE LA INTERFAZ
        echo '<script> alert ("Estimado Usuario, Existen Datos Vacios En El Formulario");</script>';
        echo '<script> window.location= "register_usu.php"</script>';
    } else {
        $register_user = $connection->prepare("INSERT INTO user(document,name,surname,date_user,username,telephone,email,id_type_user,id_gender,password,id_state) VALUES('$document_user','$name_user','$surname','$datetime' ,'$username','$telephone','$email','$type_user','$id_gender','$user_password','$id_state')");
        $register_user->execute();
        echo '<script>alert ("Registro Exitoso ¡Bienvenido/a!, Puede Iniciar Sesion.");</script>';
        echo '<script>window.location="index.php"</script>';
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
    <title>REGISTRO DE CLIENTE || SIFER APP</title>
    <link rel="shortcut icon" href="controller/image/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="controller/CSS/style_register.css">
    <link rel="shortcut icon" href="controller/image/SENA.png" type="image/x-icon">

</head>

<body onload="formreg.document.focus()">

    <video autoplay loop muted poster="controller/image/poster.png">
        <source src="controller/image/video_motos.mp4" type="video/mp4">
    </video>

    <!-- FORM CONTAINER -->
    <main>
        <div class="container_title">
            <header>REGISTRO DE CLIENTE</header>
        </div>
        <form method="POST" name="formreg" action="" autocomplete="off" id="formulario" class="formulario">

            <!-- Container: Document -->

            <div class="formulario__grupo" id="grupo__document">
                <label for="document" class="formulario__label">Numero de documento</label>
                <div class="formulario__grupo-input">
                    <input type="tel" minlength="6" onkeypress="return(multiplenumber(event));" maxlength="10" oninput="maxlengthNumber(this);" class="formulario__input" name="document" title="Numero de documento" id="document" required placeholder="Ingrese su numero de documento">
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">Debe ingresar solo numeros y el numero de documento debe ser de 6 a 10 numeros.</p>
            </div>

            <!-- Container: Nombre -->

            <div class="formulario__grupo" id="grupo__name">
                <label for="name" class="formulario__label">Nombre Completo</label>
                <div class="formulario__grupo-input">
                    <input type="text" class="formulario__input" minlength="5" oninput="maxlengthNumber(this);" onkeypress="return(textspace(event));" maxlength="20" name="name" required id="name" placeholder="Ingrese sus nombres">
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">Debe ingresar solo letras, y debe indicar su nombres completos.</p>
            </div>

            <!-- Container: Apellidos -->

            <div class="formulario__grupo" id="grupo__surname">
                <label for="surname" class="formulario__label">Apellidos Completos</label>
                <div class="formulario__grupo-input">
                    <input type="text" class="formulario__input" onkeypress="return(textspace(event));" pattern="[A-Za-z]+" maxlength="20" minlength="5" name="surname" required id="surname" placeholder="Ingrese sus apellidos">
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>
            </div>

            <!-- Container: Username -->
            <div class="formulario__grupo" id="grupo__username">
                <label for="username" class="formulario__label">Nombre de Usuario</label>
                <div class="formulario__grupo-input">
                    <input type="text" minlength="6" maxlength="12" onkeypress="return(textguions(event));" oninput="(maxlengthNumber(this))" class="formulario__input" name="username" required id="username" placeholder="Ingrese su nombre de usuario">
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">El usuario tiene que ser de 10 a 12 dígitos y solo puede contener numeros, letras y guion bajo.</p>
            </div>

            <!-- Container: Password -->
            <div class="formulario__grupo" id="grupo__password">
                <label for="password" class="formulario__label">Contraseña de Usuario</label>
                <div class="formulario__grupo-input">
                    <input type="password" onkeypress="validarPassword(event)" minlength="10" maxlength="15" class="formulario__input" name="password" oninput="maxlengthNumber(this);" required id="password" placeholder="Ingrese su contraseña">
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">La contraseña tiene que ser de 10 a 15 dígitos y solo puede contener numeros, letras y guiones bajos.</p>
            </div>

            <!-- Group: Password 2 -->

            <div class="formulario__grupo" id="grupo__password2">
                <label for="password2" class="formulario__label">Repetir Contraseña</label>
                <div class="formulario__grupo-input">
                    <input type="password" onkeypress="validarPassword(event)" minlength="10" class="formulario__input" maxlength="15" name="password2" oninput=" maxlengthNumber(this);" required id="password2" placeholder="Repita su contraseña">
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">Ambas contraseñas deben ser iguales.</p>
            </div>

            <!-- Container: telephone -->
            <div class="formulario__grupo" id="grupo__telephone">
                <label for="telephone" class="formulario__label">Numero de Celular</label>
                <div class="formulario__grupo-input">
                    <input type="tel" minlength="10" class="formulario__input" maxlength="10" onkeypress="return(multiplenumber(event));" name="telephone" oninput="maxcelNumber(this);" required id="telephone" placeholder="Ingrese su numero de contacto">
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">Debe ingresar su numero telefonico y solo se permite ingreso de diez datos numericos.</p>
            </div>

            <!-- Container: Terminos y Condiciones -->
            <div class="formulario__grupo formulario__checkbox" id="grupo__terminos">
                <label class="formulario__label">
                    <input type="checkbox" name="terminos" id="terminos">
                    Acepto los Terminos y Condiciones <br> para el uso de mis datos
                </label>
            </div>

            <!-- Container: email -->
            <div class="formulario__grupo" id="grupo__email">
                <label for="email" class="formulario__label">Correo Electronico</label>
                <div class="formulario__grupo-input">
                    <input type="email" maxlength="30" oninput="maxlengthNumber(this);" class="formulario__input" name="email" required id="email" placeholder="Ingrese su correo electronico">
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">Su correo solo puede contener letras, numeros, puntos, guiones y guiones bajos. Obligatoriamente debe tener el signo arroba "@".
                <p>
            </div>

            <!-- Container: fecha de nacimiento -->

            <div class="formulario__grupo" id="grupo__datetime">
                <label for="telephone" class="formulario__label">Fecha de nacimiento</label>
                <div class="formulario__grupo-input">
                    <input type="date" class="formulario__input" value="fechaCumple()" min="1940-01-01" name="datetime" required id="fecha-nacimiento" placeholder="Ingrese su fecha de nacimiento">
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">Debe ingresar su fecha de nacimiento</p>
            </div>

            <!-- Container Type User -->
            <div class="state">
                <input class="cajas" type="hidden" value="3" name="id_type_user" placeholder="Ingrese su tipo de usuario">
            </div>

            <!-- Container Type Gender -->
            <div class="fomulario__grupo container_gender">
                <label for="" class="formulario__label label">
                    <option value="">Selecccion Tipo de Genero</option>
                </label>
                <div class="formulario__grupo__input formulario__input">
                    <?php
                    do {
                    ?>
                        <input class="gender" name="id_gender" type="radio" value="<?php echo ($gender['id_gender']) ?>"> <?php echo ($gender['gender']) ?></input>
                    <?php

                    } while ($gender = $select_gender->fetch(PDO::FETCH_ASSOC));
                    ?>
                </div>
            </div>

            <!-- Container: State_user -->
            <div class="state">
                <input class="cajas" type="hidden" value="2" name="id_state" placeholder="Ingrese su estado">
            </div>



            <div class="formulario__grupo formulario__grupo-btn-enviar">
                <input type="submit" name="validar" value="Registrarme" class="formulario__btn"></input>
                <input type="hidden" name="MM_insert" value="formreg">
                <a href="index.php" class="return">Regresar</a>
            </div>
        </form>
    </main>

    <script src="controller/js/formulario.js"></script>
    <script src="controller/js/funciones.js"></script>
    <script src="controller/js/fontawesome.js"></script>
    <script src="controller/js/password.js"></script>

</body>

</html>
<?php
session_start();
require_once("../database/connection.php");
$db = new Database();
$connection = $db->conectar();

if ($_POST["iniciar"]) {


    //Iniciar sesion para los usuarios
    $usuario = $_POST["username"];
    $document = $_POST["document"];
    $clave = $_POST['password'];
    $id_usuario = $_POST["document"];

    // VARIABLES A LAS CUALES SE LES ASIGNA LOS VALORES RECIBIDOS DE LA FECHA Y HORA DE INGRESO DL USUARIO

    //Consultamos el usuario y la clave//

    $container = $connection->prepare("SELECT * FROM user WHERE username ='$usuario' AND document='$document' AND id_state=1");
    $container->execute();
    $fila = $container->fetch();

    if ($fila && password_verify($clave, $fila['password'])) {

        // DECLARACION DE LAS VARIABLES GLOBALES DE LA SESSIONS
        $_SESSION['id_user'] = $fila['document'];
        $_SESSION['nombres'] = $fila['name'];
        $_SESSION['apellidos'] = $fila['surname'];
        $_SESSION['tipo'] = $fila['id_type_user'];
        $_SESSION['usuario'] = $fila['username'];
        $_SESSION['id_estado'] = $fila['id_state'];
        $_SESSION['id_genero'] = $fila['id_gender'];
        $_SESSION['clave'] = $fila['password'];
        $_SESSION['telephone'] = $fila['telephone'];
        $_SESSION['email'] = $fila['email'];


        // HORARIO PREDETERMINADO PARA EL REGISTRO DE INGRESO DEL USUARIO A SU INTERFAZ
        date_default_timezone_set("America/Bogota");

        // REGISTRO DE INGRESO DEL USUARIO PARA VERIFICAR QUE TIPO DE USUARIO INGRESO

        $userentry = $connection->prepare("INSERT INTO datetime_entry(date_entry,document) VALUES(now(),'$id_usuario')");
        $userentry->execute();
        $date_entry = $userentry->fetchAll(PDO::FETCH_ASSOC);



        ///dependiendo del tipo de usuario lo redireccionamos a una su pagina correspondiente//

        if ($_SESSION['tipo'] == 1) {

            header("Location:../model/admin/index.php");
            exit();
        } elseif ($_SESSION['tipo'] == 2) {

            header("Location:../model/vendedor/index.php");
            exit();
        } elseif ($_SESSION['tipo'] == 3) {

            header("Location:../model/usuario/index.php");
            exit();
        }
    } else {

        $selectDocumento = $connection->prepare("SELECT * FROM user WHERE document = '$document'");
        $selectDocumento->execute();
        $trueDocument = $selectDocumento->fetch(PDO::FETCH_ASSOC);

        if ($trueDocument) {
            // DEFINIMOS EL HORARIO
            date_default_timezone_set('America/Bogota');
            $fecha_actual = date("Y-m-d");

            // CREAMOS LA VARIABLE PARA ALMACENAR LA CANTIDAD DE INTENTOS POSIBLES
            $posibilidades = 3;

            // CREAMOS LA CONSULTA PARA REALIZAR EL CONTEO DE LOS INTENTOS QUE HA REALIZADO EL USUARIO
            $intentos = $connection->prepare("SELECT COUNT(*) AS conteo FROM intentos WHERE document = ? AND fecha_actual = ?");
            $intentos->execute([$document, $fecha_actual]);
            $intento = $intentos->fetch(PDO::FETCH_ASSOC);

            if ($intento['conteo'] == $posibilidades) { // Verificar el valor de "conteo"
                $update_state = $connection->prepare("UPDATE user SET id_state = 2 WHERE document = '$document'");
                if ($update_state->execute()) {
                    echo '<script>alert("Has superado la cantidad de intentos posibles, tu estado ha cambiado a cuenta inactiva.");</script>';
                    echo '<script>window.location="../error.php"</script>';
                }
            } else {
                $registrointentos = $connection->prepare("INSERT INTO intentos(document, fecha_actual) VALUES ('$document','$fecha_actual')");
                if ($registrointentos->execute()){
                    // CREAMOS LA CONSULTA PARA REALIZAR EL CONTEO DE LOS INTENTOS QUE HA REALIZADO EL USUARIO
                    $intentosPosibles = $connection->prepare("SELECT COUNT(*) AS contador FROM intentos WHERE document = ? AND fecha_actual = ?");
                    $intentosPosibles->execute([$document, $fecha_actual]);
                    $intentoUsuario = $intentosPosibles->fetch(PDO::FETCH_ASSOC);

                    if ($intentoUsuario['contador'] == $posibilidades) { // Verificar el valor de "conteo"
                        $update_state = $connection->prepare("UPDATE user SET id_state = 2 WHERE document = '$document'");
                        if ($update_state->execute()) {
                            echo '<script>alert("Has superado la cantidad de intentos posibles, tu estado ha cambiado a cuenta inactiva.");</script>';
                            echo '<script>window.location="../error.php"</script>';
                        }
                    } else {

                        echo '<script>alert("El numero de documento o la contraseña son incorrectos.");</script>';
                        header("Location:../error.php");
                    }
                } else {
                    echo '<script>alert("El numero de documento o la contraseña son incorrectos.");</script>';
                    header("Location:../error.php");
                }
            }
        }

    }

}
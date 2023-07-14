<?php
session_start();
require_once("../database/connection.php");
$db = new Database();
$connection = $db->conectar();

if($_POST["iniciar"]){


    //Iniciar sesion para los usuarios
    $usuario= $_POST["username"];
    $document=$_POST["document"];
    $clave= $_POST['password'];
    $id_usuario=$_POST["document"];

    // VARIABLES A LAS CUALES SE LES ASIGNA LOS VALORES RECIBIDOS DE LA FECHA Y HORA DE INGRESO DL USUARIO

    //Consultamos el usuario y la clave//

    $container=$connection->prepare("SELECT * FROM user WHERE username ='$usuario' AND document='$document' AND id_state=1");
    $container->execute();
    $fila=$container->fetch();
    
    if ($fila && password_verify($clave,$fila['password'])){

        // DECLARACION DE LAS VARIABLES GLOBALES DE LA SESSIONS
        $_SESSION['id_user']=$fila['document'];
        $_SESSION['nombres']=$fila['name'];
        $_SESSION['apellidos']=$fila['surname'];
        $_SESSION['tipo']=$fila['id_type_user'];
        $_SESSION['usuario']=$fila['username'];
        $_SESSION['id_estado']=$fila['id_state'];
        $_SESSION['id_genero']=$fila['id_gender'];
        $_SESSION['clave']=$fila['password'];
        $_SESSION['telephone']=$fila['telephone'];
        $_SESSION['email']=$fila['email'];

        
        // HORARIO PREDETERMINADO PARA EL REGISTRO DE INGRESO DEL USUARIO A SU INTERFAZ       
        date_default_timezone_set("America/Bogota");

        // REGISTRO DE INGRESO DEL USUARIO PARA VERIFICAR QUE TIPO DE USUARIO INGRESO      

        $userentry=$connection->prepare("INSERT INTO datetime_entry(date_entry,document) VALUES(now(),'$id_usuario')");
        $userentry->execute();
        $date_entry=$userentry->fetchAll(PDO::FETCH_ASSOC);


        
        ///dependiendo del tipo de usuario lo redireccionamos a una su pagina correspondiente// 

        if($_SESSION['tipo']==1){

            header("Location:../model/admin/index.php");
            exit();
        }
        else if($_SESSION['tipo']==2){

            header("Location:../model/vendedor/index.php");
            exit();
        }
        else if($_SESSION['tipo']==3){

            header("Location:../model/usuario/index.php");
            exit();
        }
    }else{
        //Si el nombre de usuario el documento y la clave son incorrectas y se encuentra inactivo en el software lo lleva a la pagina de inicio de sesion//
        header("Location:../error.php");

    }
}
?>

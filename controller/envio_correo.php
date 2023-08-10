<?php

session_start();
require_once("../database/connection.php");
$db = new Database();
$connection = $db->conectar();



function encriptar($texto, $token) {
    $clave = md5($token); // Generar clave a partir de la semilla
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $textoEncriptado = openssl_encrypt($texto, 'aes-256-cbc', $clave, 0, $iv);
    return base64_encode($iv . $textoEncriptado);
}

function desencriptar($textoEncriptado, $semilla) {
    $clave = md5($semilla); // Generar clave a partir de la semilla
    $textoEncriptado = base64_decode($textoEncriptado);
    $ivTamanio = openssl_cipher_iv_length('aes-256-cbc');
    $iv = substr($textoEncriptado, 0, $ivTamanio);
    $textoEncriptado = substr($textoEncriptado, $ivTamanio);
    return openssl_decrypt($textoEncriptado, 'aes-256-cbc', $clave, 0, $iv);
}

$token = "11SXDLSLDDDDKFE332KDKS";


if ((isset($_POST["MM_correo"])) && ($_POST["MM_correo"] == "formCorreo")) {

    $correo_electronico = $_POST['email'];

    $authEmail = $connection->prepare("SELECT * FROM user WHERE email = ?");
    $authEmail->execute([$correo_electronico]);
    $email = $authEmail->fetch(PDO::FETCH_ASSOC);

    if ($email) {
        // ENVIO DE CORREO ELECTRONICO

        $documentUser = $email['document'];


        // Encriptacion del numero de documento 

        $documentoEncriptado = encriptar($documentUser, $token);

        $asunto = "Cambio de contraseña de " . $email['name'] . " " . $email['surname'] ;
        $message = "Estimado Usuario, haz solicitado un cambio de contraseña para la dirección de correo electrónico: " . $correo_electronico . "\n";
        $message .= "Para continuar, haz clic en el siguiente enlace: http://localhost/sifer-app/controller/recuperar_contrasena.php?smtp=" . urlencode($documentoEncriptado);

        $admin_email = "From:lamunoz0140@misena.edu.co";

        if (mail($correo_electronico, $asunto, $message, $admin_email)) {
            echo '<script>alert("Estimado Usuario ' . $email['name'] . " " . $email['surname'] .  " " . 'Por favor verifica tu correo electronico, te enviamos un enlace que habilita tu cambio de contraseña.");</script>';
            echo '<script>window.location="../index.php"</script>';
        } else {
            echo '<script>alert("Error, no se pudo habilitar el cambio de contraseña");</script>';
            echo '<script>window.location="../index.php"</script>';
        }
    } else {
        echo '<script>alert("El correo electronico no esta registrado.");</script>';
        echo '<script>window.location="authentication.php"</script>';
    }
}

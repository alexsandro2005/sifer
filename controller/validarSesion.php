<?php

    // Archivo que permite validar la sesion

if(!isset($_SESSION['usuario'])|| !isset($_SESSION['tipo']))
{
    header("Location:../../index.php");
}

?>
<?php

if (!isset($_SESSION['usuario']) || !isset($_SESSION['tipo'])) {
    echo "<script>alert('Debes iniciar sesión');</script>";
    header("Location:../../index.php");
    exit; // Agregar exit para asegurar que el script se detenga
}

?>
<?php

session_start();

unset($_SESSION["carrito_completo"]);
$_SESSION["carrito_completo"] = [];

header("Location: ./vender_completo.php?status=2");
?>
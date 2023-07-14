<?php
session_start();

unset($_SESSION["carrito_servicio"]);
$_SESSION["carrito_venta"]=[];

header("Location:./vender_servicio.php?status=2");



?>
<?php
session_start();
require_once("../../database/connection.php");
$db = new Database();
$connection=$db->conectar();

if (!isset($_POST["code_service"])) {
    return;
}

$codigo = $_POST["code_service"];
$sentencia = $connection->prepare("SELECT * FROM services WHERE code_service = ? LIMIT 1;");
$sentencia->execute([$codigo]);
$producto = $sentencia->fetch(PDO::FETCH_OBJ);
# Si no existe, salimos y lo indicamos
if (!$producto) {
    header("Location: vender_ser.php?status=4");
    exit;
}
# Si no hay existencia...
if ($producto->cantidad_ser < 1) {
    header("Location:vender_ser.php?status=5");
    exit;
}
# Buscar producto dentro del cartito
$indice = false;
for ($i = 0; $i < count($_SESSION["carrito"]); $i++) {
    if ($_SESSION["carrito"][$i]->code_service === $codigo) {
        $indice = $i;
        break;
    }
}
# Si no existe, lo agregamos como nuevo
if ($indice === false) {
    $producto->cantidad_ser = 1;
    $producto->total_ser = $producto->costo_service;
    array_push($_SESSION["carrito"], $producto);
} else {
    # Si ya existe, se agrega la cantidad
    # Pero espera, tal vez ya no haya
    $cantidadExistente = $_SESSION["carrito"][$indice]->existencia_ser;
    # si al sumarle uno supera lo que existe, no se agrega
    if ($cantidadExistente + 0 > $producto->services) {
        header("Location: vender_ser.php?status=5");
        exit;
    }
    $_SESSION["carrito"][$indice]->cantidad_ser++;
    $_SESSION["carrito"][$indice]->total_ser = $_SESSION["carrito"][$indice]->cantidad_ser* $_SESSION["carrito"][$indice]->costo_service;
}
header("Location: vender_ser.php");
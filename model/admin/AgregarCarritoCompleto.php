<?php
session_start();
require_once("../../database/connection.php");
$db = new Database();
$connection = $db->conectar();

if (!isset($_POST["codigo"]) == "formreg") {
    return;
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formreg")) {

    $codigo = $_POST["codigo"];
    $sentencia = $connection->prepare("SELECT * FROM productos WHERE codigo = ? LIMIT 1;");
    $sentencia->execute([$codigo]);
    $producto = $sentencia->fetch(PDO::FETCH_OBJ);
    # Si no existe, salimos y lo indicamos
    if (!$producto) {
        header("Location: ./vender_completo.php?status=4");
        exit;
    }
    # Si no hay existencia...
    if ($producto->cantidad < 1) {
        header("Location: ./vender_completo.php?status=5");
        exit;
    }
    # Buscar producto dentro del cartito
    $indice = false;
    for ($i = 0; $i < count($_SESSION["carrito"]); $i++) {
        if ($_SESSION["carrito"][$i]->codigo === $codigo) {
            $indice = $i;
            break;
        }
    }
    # Si no existe, lo agregamos como nuevo
    if ($indice === false) {
        $producto->cantidad = 1;
        $producto->total = $producto->precio;
        array_push($_SESSION["carrito"], $producto);
    } else {
        # Si ya existe, se agrega la cantidad
        # Pero espera, tal vez ya no haya
        $cantidadExistente = $_SESSION["carrito"][$indice]->existencia;
        # si al sumarle uno supera lo que existe, no se agrega
        if ($cantidadExistente + 0 > $producto->producto) {
            header("Location: ./vender_completo.php?status=5");
            exit;
        }
        $_SESSION["carrito"][$indice]->cantidad++;
        $_SESSION["carrito"][$indice]->total = $_SESSION["carrito"][$indice]->cantidad * $_SESSION["carrito"][$indice]->precio;
    }
    header("Location: ./vender_completo.php");
}


if ((isset($_POST["insert"])) && ($_POST["insert"] == "formdocumentos")) {

    $codigo = $_POST["codigo"];
    $sentencia = $connection->prepare("SELECT * FROM documentos WHERE codigo = ? LIMIT 1;");
    $sentencia->execute([$codigo]);
    $documento = $sentencia->fetch(PDO::FETCH_OBJ);
    # Si no existe, salimos y lo indicamos
    if (!$documento) {
        header("Location: ./vender_completo.php?status=4");
        exit;
    }
    # Si no hay existencia...
    if ($producto->cantidad < 1) {
        header("Location: ./vender_completo.php?status=5");
        exit;
    }
    # Buscar producto dentro del cartito
    $indice = false;
    for ($i = 0; $i < count($_SESSION["carrito"]); $i++) {
        if ($_SESSION["carrito"][$i]->codigo === $codigo) {
            $indice = $i;
            break;
        }
    }
    # Si no existe, lo agregamos como nuevo
    if ($indice === false) {
        $documento->cantidad = 1;
        $documento->total = $documento->precio;
        array_push($_SESSION["carrito"], $documento);
    } else {
        # Si ya existe, se agrega la cantidad
        # Pero espera, tal vez ya no haya
        $cantidadExistente = $_SESSION["carrito"][$indice]->existencia;
        # si al sumarle uno supera lo que existe, no se agrega
        if ($cantidadExistente + 0 > $producto->producto) {
            header("Location: ./vender_completo.php?status=5");
            exit;
        }
        $_SESSION["carrito"][$indice]->cantidad++;
        $_SESSION["carrito"][$indice]->total = $_SESSION["carrito"][$indice]->cantidad * $_SESSION["carrito"][$indice]->precio;
    }
    header("Location: ./vender_completo.php");
}


if ((isset($_POST["SS_insert"])) && ($_POST["SS_insert"] == "formservices")) {

    $codigo = $_POST["codigo"];
    $sentencia = $connection->prepare("SELECT * FROM servicios WHERE codigo = ? LIMIT 1;");
    $sentencia->execute([$codigo]);
    $servicio = $sentencia->fetch(PDO::FETCH_OBJ);
    # Si no existe, salimos y lo indicamos
    if (!$servicio) {
        header("Location: ./vender_completo.php?status=4");
        exit;
    }
    # Si no hay existencia...
    if ($servicio->cantidad < 1) {
        header("Location: ./vender_completo.php?status=5");
        exit;
    }
    # Buscar producto dentro del cartito
    $indice = false;
    for ($i = 0; $i < count($_SESSION["carrito"]); $i++) {
        if ($_SESSION["carrito"][$i]->codigo === $codigo) {
            $indice = $i;
            break;
        }
    }
    # Si no existe, lo agregamos como nuevo
    if ($indice === false) {
        $servicio->cantidad = 1;
        $servicio->total = $servicio->precio;
        array_push($_SESSION["carrito"], $servicio);
    } else {
        # Si ya existe, se agrega la cantidad
        # Pero espera, tal vez ya no haya
        $cantidadExistente = $_SESSION["carrito"][$indice]->existencia;
        # si al sumarle uno supera lo que existe, no se agrega
        if ($cantidadExistente + 0 > $servicio->servicio) {
            header("Location: ./vender_completo.php?status=5");
            exit;
        }
        $_SESSION["carrito"][$indice]->cantidad++;
        $_SESSION["carrito"][$indice]->total = $_SESSION["carrito"][$indice]->cantidad * $_SESSION["carrito"][$indice]->precio;
    }
    header("Location: ./vender_completo.php");
}

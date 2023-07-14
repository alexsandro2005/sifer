<?php

session_start();
require_once("../../database/connection.php");
$db = new Database();
$connection=$db->conectar();

if(!isset($_POST["total"])) exit;


date_default_timezone_set('America/Bogota');

$total = $_POST["total"];
$documento=$_POST['document'];
$placa=$_POST['placa'];
$ahora= date("y-m-d h:i:s");

$sentencia = $connection->prepare("INSERT INTO ventas(document,placa,fecha, total) VALUES (?,?,?,?)");
$sentencia->execute([$documento,$placa,$ahora,$total]);
$sentencia = $connection->prepare("SELECT id FROM ventas ORDER BY id DESC LIMIT 1;");
$sentencia->execute();
$resultado = $sentencia->fetch(PDO::FETCH_OBJ);

$idVenta = $resultado === false ? 1 : $resultado->id;

$connection->beginTransaction();
$sentencia = $connection->prepare("INSERT INTO productos_vendidos(id_producto,id_venta, existencia) VALUES (?, ?, ?);");
$sentenciaExistencia = $connection->prepare("UPDATE productos SET cantidad = cantidad - ? WHERE id = ?;");
foreach ($_SESSION["carrito"] as $producto) {
	$total += $producto->total;
	$sentencia->execute([$producto->id, $idVenta, $producto->cantidad]);
	$sentenciaExistencia->execute([$producto->cantidad, $producto->id]);
}
$connection->commit();
unset($_SESSION["carrito"]);
$_SESSION["carrito"] = [];
header("Location: ./vender.php?status=1");
?>
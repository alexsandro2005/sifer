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
$ahora= new DateTime();

$fecha_fin = clone $ahora;
$fecha_fin->add(new DateInterval('P1Y'));



$sentencia = $connection->prepare("INSERT INTO venta_documentos(documento,placa,fecha,fecha_fin,total) VALUES (?,?,?,?,?)");
$sentencia->execute([$documento,$placa,$ahora->format('Y-m-d H:i:s'),$fecha_fin->format('Y-m-d H:i:s'),$total]);
$sentencia = $connection->prepare("SELECT id_venta FROM venta_documentos ORDER BY id_venta DESC LIMIT 1;");
$sentencia->execute();
$resultado = $sentencia->fetch(PDO::FETCH_OBJ);

$idVenta = $resultado === false ? 1 : $resultado->id_venta;

$connection->beginTransaction();

$sentencia = $connection->prepare("INSERT INTO documentos_vendidos(id_documento,id_venta,existencia) VALUES (?,?,?)");
foreach ($_SESSION["carrito_venta"] as $documento) {
	$total += $documento->total;
	$sentencia->execute([$documento->id_documento,$idVenta,$documento->cantidad]);
}
$connection->commit();
unset($_SESSION["carrito_venta"]);
$_SESSION["carrito_venta"] = [];
header("Location: ./ventas_documento.php");
?>
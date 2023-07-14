<?php
session_start();
require_once("../../database/connection.php");
$db = new Database();
$connection=$db->conectar();

#Salir si alguno de los datos no está presente
if(
	!isset($_POST["codigo"]) || 
	!isset($_POST["name"]) || 
	!isset($_POST["precio"]) || 
	!isset($_POST["marca"]) || 
	!isset($_POST["cantidad"]) || 
	!isset($_POST["id"])
) exit();

#Si todo va bien, se ejecuta esta parte del código...
$id = $_POST["id"];
$codigo = $_POST["codigo"];
$name = $_POST["name"];
$precio = $_POST["precio"];
$marca = $_POST["marca"];
$cantidad = $_POST["cantidad"];

$sentencia = $connection->prepare("UPDATE productos SET codigo = ?, name_pro = ?, precio = ?, id_marca = ?, cantidad = ? WHERE id = ?;");
$resultado = $sentencia->execute([$codigo, $name, $precio, $marca, $cantidad, $id]);

if($resultado === TRUE){
	header("Location: ./lista_products.php");
	exit;
}
else echo "Algo salió mal. Por favor verifica que la tabla exista, así como el ID del producto";
?>
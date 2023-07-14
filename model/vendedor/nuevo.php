<?php
session_start();
require_once("../../database/connection.php");
$db = new Database();
$connection=$db->conectar();
#Salir si alguno de los datos no está presente
if(!isset($_POST["codigo"]) || !isset($_POST["name"]) || !isset($_POST["precio"]) || !isset($_POST["marca"]) || !isset($_POST["cantidad"])) exit();

#Si todo va bien, se ejecuta esta parte del código...


$codigo = $_POST["codigo"];
$name = $_POST["name"];
$precio = $_POST["precio"];
$marca = $_POST["marca"];
$cantidad = $_POST["cantidad"];

$sentencia = $connection->prepare("INSERT INTO productos(codigo, name_pro, precio, id_estado,id_marca, cantidad) VALUES (?, ?, ?,1, ?, ?);");
$resultado = $sentencia->execute([$codigo, $name, $precio, $marca, $cantidad]);

if($resultado === TRUE){
	header("location:lista_products.php");
	exit;
}
else echo "Algo salió mal. Por favor verifica que la tabla exista";


?>
<?php include_once "pie.php" ?>
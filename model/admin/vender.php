<?php
session_start();
require_once("../../database/connection.php");
$db = new Database();
$connection = $db->conectar();

require_once("../../controller/validarSesion.php");

if (isset($_POST['btncerrar'])) {
	session_destroy();
	header("Location:../../index.php");
}

$consul = $connection->prepare("SELECT * FROM user WHERE id_type_user = 2");
$consul->execute();
$name = $consul->fetch();

$consul1 = $connection->prepare("SELECT * FROM motorcycles");
$consul1->execute();
$placa = $consul1->fetch();

$sql = $connection->prepare("SELECT * FROM user,type_user WHERE  username ='" . $_SESSION['usuario'] . "' AND user.id_type_user = type_user.id_type_user");
$sql->execute();
$usua = $sql->fetch(PDO::FETCH_ASSOC);


?>
<?php
$control = $connection->prepare("SELECT * FROM type_user");
$control->execute();
$type_user = $control->fetch(PDO::FETCH_ASSOC);


$comando = $connection->prepare("SELECT * FROM datetime_entry INNER JOIN user INNER JOIN type_user ON datetime_entry.document = user.document AND user.id_type_user = type_user.id_type_user ORDER BY id_entry DESC");
$comando->execute();
$resultado = $comando->fetch(PDO::FETCH_ASSOC);

?>
<?php

?>
<?php
if (!isset($_SESSION["carrito"])) $_SESSION["carrito"] = [];
$granTotal = 0;
?>


<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<!-- CSS personalizado -->
	<link rel="stylesheet" href="main.css">

	<!--datables CSS básico-->
	<link rel="stylesheet" type="text/css" href="datatables/datatables.min.css" />
	<!--datables estilo bootstrap 4 CSS-->
	<link rel="stylesheet" type="text/css" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="../../controller/css/custom.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<title>VENDER PRODUCTOS</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="../../controller/CSS/bootstrap.min.css">
	<!----css3---->
	<link rel="stylesheet" href="../../controller/CSS/custom.css">
	<!--google fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
	<link rel="shortcut icon" href="../../controller/image/favicon.png" type="image/x-icon">

	<!--google material icon-->
	<link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">

	<!--font awesome con CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

</head>

<body>

	<?php

	include('./menu.php');
	?>

	<div class="xp-breadcrumbbar text-center">
		<h4 class="page-title"><span>GENERAR VENTA</span></h4>
		<ol class="breadcrumb">
		</ol>
	</div>

	</div>
	</div>
	<div>

		<div class="container-fluid">
			<div class="col-xs-15 mt-5">
				<?php
				if (isset($_GET["status"])) {
					if ($_GET["status"] === "1") {
				?>
						<div class="alert alert-success">
							<strong>¡Correcto!</strong> Venta realizada correctamente
						</div>
					<?php
					} else if ($_GET["status"] === "2") {
					?>
						<div class="alert alert-info">
							<strong>Venta cancelada</strong>
						</div>
					<?php
					} else if ($_GET["status"] === "3") {
					?>
						<div class="alert alert-info">
							<strong>Retiroso exitoso</strong>, Producto quitado de la lista.
						</div>
					<?php
					} else if ($_GET["status"] === "4") {
					?>
						<div class="alert alert-warning">
							<strong>Error:</strong> El producto que buscas no existe
						</div>
					<?php
					} else if ($_GET["status"] === "5") {
					?>
						<div class="alert alert-danger">
							<strong>Error: </strong>El producto está agotado
						</div>
					<?php
					} else {
					?>
						<div class="alert alert-danger">
							<strong>Error:</strong> Algo salió mal mientras se realizaba la venta
						</div>
				<?php
					}
				}
				?>

				<!------top-navbar-end----------->
			</div>
		</div>

		<?php

		$productos = $connection->prepare("SELECT * FROM productos");
		$productos->execute();
		$select_productos = $productos->fetch(PDO::FETCH_ASSOC);

		?> <br>
		<div class="container-fluid">
			<div class="col-xs-12">
				<form method="post" name="formreg" action="agregarAlCarrito.php">
					<label for="codigo">Código de barras:</label>

					<select class="form-control" name="codigo" required id="control">
						<option value="">Seleccione un producto:</option>
						<?php
						do {
						?>
							<option value="<?php echo ($select_productos['codigo']) ?>"><?php echo ($select_productos['name_pro']) ?></option>
						<?php
						} while ($select_productos = $productos->fetch(PDO::FETCH_ASSOC));
						?>

					</select>
					<div class="mt-4">
						<input class="btn btn-info" type="submit" value="Agregar producto">
						<input type="hidden" name="MM_insert" value="formreg">
					</div>

				</form>
				<br><br>
				<ul id="lista"></ul>
				<table class="table table-bordered">
					<thead>
						<tr>
							
							<th>Código</th>
							<th>Nombre del producto</th>
							<th>Precio del producto</th>
							<th>marca</th>
							<th>Total</th>
							<th>Cantidad</th>
							<th>quitar</th>
						</tr>
					</thead>

					<tbody>
						<?php foreach ($_SESSION["carrito"] as $indice => $producto) {
							$granTotal += $producto->total;
						?>
							<tr>
								<td><?php echo $producto->codigo ?></td>
								<td><?php echo $producto->name_pro ?></td>
								<td><?php echo $producto->precio ?></td>
								<td><?php echo $producto->id_marca ?></td>
								<td><?php echo $producto->total ?></td>
								<td><?php echo $producto->cantidad ?></td>
								<td><a class="btn btn-danger" href="<?php echo "quitarDelCarrito.php?indice=" . $indice ?>" Style='color:white;'>Eliminar<i class="fa fa-trash"></i></a></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>

				<h3>Total: <?php echo $granTotal; ?></h3>
				<form action="./terminarVenta.php" method="POST">
					<br>
					<label>Vendedor:</label>
					<select name="document" id="" class='form-control'>
						<option> Seleccione el vendedor</option>
						<?php

						do {

						?>
							<option value=<?php echo ($name['document']) ?>><?php echo ($name['name']) ?> </option>
						<?php
						} while ($name = $consul->fetch());

						?>
					</select>
					<br>
					<label>Placa de la Moto</label>
					<select name="placa" id="" class='form-control'>
						<option> Seleccione la placa</option>
						<?php

						do {

						?>
							<option value=<?php echo ($placa['placa']) ?>><?php echo ($placa['placa']) ?> </option>
						<?php
						} while ($placa = $consul1->fetch());

						?>
					</select>
					<br>

					<div class=" mb-4">
						<input name="total" type="hidden" value="<?php echo $granTotal; ?>">
						<button type="submit" class="btn btn-info">Terminar venta</button>
						<a href="./cancelarVenta.php" class="btn btn-danger">Cancelar venta</a>
					</div>

				</form>

			</div>
		</div>


		<!------main-content-end----------->

		<!----footer-design------------->

		<footer class="footer">
			<div class="container-fluid">
				<div class="footer-in">
					<p class="mb-0"> Derechos reservados &copy Sifer-App 2023</p>
				</div>
			</div>
		</footer>

	</div>

	</div>
	</div>

	</div>

	<!-- AUTOCOMPLETE CON JSON PARA INVOCAR VALORES CON EL CODIGO DE BARRAS PARA TRAERSE TODA LA INFORMACION DE LOS PRODUCTOS -->

	<script src="../../controller/JS/peticiones.js"></script>


	<!-- BUSCADORES EN TIEMPO REAL DEL SELECT AL CUAL FUE ASIGNADO CON EL ID UNICO -->

	<script>
		$('#control').select2();
	</script>
	<!-------complete html----------->
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="./js/jquery-3.3.1.slim.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$(".xp-menubar").on('click', function() {
				$("#sidebar").toggleClass('active');
				$("#content").toggleClass('active');
			});

			$('.xp-menubar,.body-overlay').on('click', function() {
				$("#sidebar,.body-overlay").toggleClass('show-nav');
			});

		});
	</script>

</body>

</html>
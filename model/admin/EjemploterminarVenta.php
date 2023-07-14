<?php
session_start();
include('config.php');

if (!isset($_SESSION['carrito_productos'])) {
    $_SESSION['carrito_productos'] = [];
}

if (!isset($_SESSION['carrito_servicios'])) {
    $_SESSION['carrito_servicios'] = [];
}

if (!isset($_SESSION['carrito_documentos'])) {
    $_SESSION['carrito_documentos'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $usuario = $_POST['usuario'];
    $vendedor = $_POST['vendedor'];
    $productos = $_POST['productos'];
    $servicios = $_POST['servicios'];
    $documentos = $_POST['documentos'];

    // Agregar productos al carrito de productos
    foreach ($productos as $productoId => $cantidad) {
        if ($cantidad > 0) {
            $_SESSION['carrito_productos'][$productoId] = $cantidad;
        }
    }

    // Agregar servicios al carrito de servicios
    foreach ($servicios as $servicioId) {
        $_SESSION['carrito_servicios'][] = $servicioId;
    }

    // Agregar documentos al carrito de documentos
    foreach ($documentos as $documentoId) {
        $_SESSION['carrito_documentos'][] = $documentoId;
    }

    // Redireccionar al carrito de compras
    header("Location: carrito.php");
    exit();
}

// Obtener todos los productos, servicios, documentos, usuarios y vendedores de la base de datos
try {
    $stmtProductos = $dbh->prepare("SELECT * FROM productos");
    $stmtProductos->execute();
    $productos = $stmtProductos->fetchAll(PDO::FETCH_ASSOC);

    $stmtServicios = $dbh->prepare("SELECT * FROM servicios");
    $stmtServicios->execute();
    $servicios = $stmtServicios->fetchAll(PDO::FETCH_ASSOC);

    $stmtDocumentos = $dbh->prepare("SELECT * FROM documentos");
    $stmtDocumentos->execute();
    $documentos = $stmtDocumentos->fetchAll(PDO::FETCH_ASSOC);

    $stmtUsuarios = $dbh->prepare("SELECT * FROM usuarios");
    $stmtUsuarios->execute();
    $usuarios = $stmtUsuarios->fetchAll(PDO::FETCH_ASSOC);

    $stmtVendedores = $dbh->prepare("SELECT * FROM vendedores");
    $stmtVendedores->execute();
    $vendedores = $stmtVendedores->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('Error al obtener los datos: ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Módulo de Ventas</title>
</head>
<body>
    <h1>Módulo de Ventas</h1>
    <form method="POST" action="">
        <h3>Usuario</h3>
        <select name="usuario">
            <option value="">Seleccione un usuario</option>
            <?php foreach ($usuarios as $usuario): ?>
                <option value="<?php echo $usuario['id_usuario']; ?>"><?php echo $usuario['nombre']; ?></option>
            <?php endforeach; ?>
        </select>

        <h3>Vendedor</h3>
        <select name="vendedor">
            <option value="">Seleccione un vendedor</option>
            <?php foreach ($vendedores as $vendedor): ?>
                <option value="<?php echo $vendedor['id_vendedor']; ?>"><?php echo $vendedor['nombre']; ?></option>
            <?php endforeach; ?>
        </select>

        <h3>Servicios</h3>
        <select name="servicios[]" multiple>
            <?php foreach ($servicios as $servicio): ?>
                <option value="<?php echo $servicio['id_servicio']; ?>"><?php echo $servicio['nombre']; ?></option>
            <?php endforeach; ?>
        </select>

        <h3>Documentos</h3>
        <select name="documentos[]" multiple>
            <?php foreach ($documentos as $documento): ?>
                <option value="<?php echo $documento['id_documento']; ?>"><?php echo $documento['nombre']; ?></option>
            <?php endforeach; ?>
        </select>

        <h3>Productos</h3>
        <?php foreach ($productos as $producto): ?>
            <label for="producto_<?php echo $producto['id_producto']; ?>">
                <?php echo $producto['nombre']; ?> (Precio: <?php echo $producto['precio']; ?>)
                <input type="number" name="productos[<?php echo $producto['id_producto']; ?>]" id="producto_<?php echo $producto['id_producto']; ?>" min="0" step="1">
            </label><br>
        <?php endforeach; ?>

        <br>
        <input type="submit" value="Agregar al Carrito">
    </form>
</body>
</html>

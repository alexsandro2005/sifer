<?php
session_start();
include('config.php');

if (!isset($_SESSION['carrito_productos']) || empty($_SESSION['carrito_productos'])) {
    header("Location: index.php");
    exit();
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

    // Iniciar la transacción
    $dbh->beginTransaction();

    try {
        // Insertar la venta
        $stmtVenta = $dbh->prepare("INSERT INTO ventas (fecha, id_usuario, id_vendedor, saldo_total) VALUES (NOW(), ?, ?, 0)");
        $stmtVenta->execute([$usuario, $vendedor]);
        $idVenta = $dbh->lastInsertId();

        $saldoTotal = 0;

        // Insertar los productos
        foreach ($_SESSION['carrito_productos'] as $productoId => $cantidad) {
            $stmtProducto = $dbh->prepare("SELECT precio FROM productos WHERE id_producto = ?");
            $stmtProducto->execute([$productoId]);
            $precioProducto = $stmtProducto->fetchColumn();

            $stmtDetalleProducto = $dbh->prepare("INSERT INTO venta_detalle (id_venta, id_producto, cantidad) VALUES (?, ?, ?)");
            $stmtDetalleProducto->execute([$idVenta, $productoId, $cantidad]);

            $saldoTotal += $precioProducto * $cantidad;
        }

        // Insertar los servicios (se permiten varios servicios)
        foreach ($_SESSION['carrito_servicios'] as $servicioId) {
            $stmtServicio = $dbh->prepare("SELECT precio FROM servicios WHERE id_servicio = ?");
            $stmtServicio->execute([$servicioId]);
            $precioServicio = $stmtServicio->fetchColumn();
            $stmtDetalleServicio = $dbh->prepare("INSERT INTO venta_detalle (id_venta, id_servicio, cantidad) VALUES (?, ?, 1)");
            $stmtDetalleServicio->execute([$idVenta, $servicioId]);

            $saldoTotal += $precioServicio;
        }

        // Insertar los documentos (se permite registrar solo una vez cada documento)
        foreach ($_SESSION['carrito_documentos'] as $documentoId) {
            $stmtDocumento = $dbh->prepare("SELECT fecha_vencimiento FROM documentos WHERE id_documento = ?");
            $stmtDocumento->execute([$documentoId]);
            $fechaVencimiento = $stmtDocumento->fetchColumn();

            $stmtDetalleDocumento = $dbh->prepare("INSERT INTO venta_detalle (id_venta, id_documento, cantidad) VALUES (?, ?, 1)");
            $stmtDetalleDocumento->execute([$idVenta, $documentoId]);

            // Verificar si el documento necesita renovación
            $hoy = date('Y-m-d');
            if ($hoy > $fechaVencimiento) {
                echo "Debe renovar el documento.";
            }
        }

        // Actualizar el saldo total de la venta
        $stmtSaldoTotal = $dbh->prepare("UPDATE ventas SET saldo_total = ? WHERE id_venta = ?");
        $stmtSaldoTotal->execute([$saldoTotal, $idVenta]);

        // Eliminar los datos del carrito
        unset($_SESSION['carrito_productos']);
        unset($_SESSION['carrito_servicios']);
        unset($_SESSION['carrito_documentos']);

        $dbh->commit();
        echo "La venta se ha registrado correctamente.";
    } catch (PDOException $e) {
        $dbh->rollback();
        die('Error al registrar la venta: ' . $e->getMessage());
    }
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
    <title>Carrito de Compras</title>
</head>
<body>
    <h1>Carrito de Compras</h1>
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

        <h3>Productos</h3>
        <?php foreach ($productos as $producto): ?>
            <?php if (isset($_SESSION['carrito_productos'][$producto['id_producto']]) && $_SESSION['carrito_productos'][$producto['id_producto']] > 0): ?>
                <p><?php echo $producto['nombre']; ?> (Cantidad: <?php echo $_SESSION['carrito_productos'][$producto['id_producto']]; ?>)</p>
            <?php endif; ?>
        <?php endforeach; ?>

        <h3>Servicios</h3>
        <?php foreach ($servicios as $servicio): ?>
            <?php if (in_array($servicio['id_servicio'], $_SESSION['carrito_servicios'])): ?>
                <p><?php echo $servicio['nombre']; ?></p>
            <?php endif; ?>
        <?php endforeach; ?>

        <h3>Documentos</h3>
        <?php foreach ($documentos as $documento): ?>
            <?php if (in_array($documento['id_documento'], $_SESSION['carrito_documentos'])): ?>
                <p><?php echo $documento['nombre']; ?></p>
            <?php endif; ?>
        <?php endforeach; ?>

        <br>
        <input type="submit" value="Realizar Venta">
    </form>
</body>
</html>

<?php
include('config.php');

// Obtener todas las ventas con sus detalles de la base de datos
try {
    $stmtVentas = $dbh->prepare("SELECT v.*, u.nombre AS nombre_usuario, ve.nombre AS nombre_vendedor
        FROM ventas AS v
        LEFT JOIN usuarios AS u ON v.id_usuario = u.id_usuario
        LEFT JOIN vendedores AS ve ON v.id_vendedor = ve.id_vendedor");
    $stmtVentas->execute();
    $ventas = $stmtVentas->fetchAll(PDO::FETCH_ASSOC);

    $stmtDetallesProductos = $dbh->prepare("SELECT vd.*, p.nombre AS nombre_producto, p.precio AS precio_producto
        FROM venta_detalle_productos AS vd
        LEFT JOIN productos AS p ON vd.id_producto = p.id_producto");
    $stmtDetallesProductos->execute();
    $detallesProductos = $stmtDetallesProductos->fetchAll(PDO::FETCH_ASSOC);

    $stmtDetallesServicios = $dbh->prepare("SELECT vd.*, s.nombre AS nombre_servicio
        FROM venta_detalle_servicios AS vd
        LEFT JOIN servicios AS s ON vd.id_servicio = s.id_servicio");
    $stmtDetallesServicios->execute();
    $detallesServicios = $stmtDetallesServicios->fetchAll(PDO::FETCH_ASSOC);

    $stmtDetallesDocumentos = $dbh->prepare("SELECT vd.*, d.nombre AS nombre_documento
        FROM venta_detalle_documentos AS vd
        LEFT JOIN documentos AS d ON vd.id_documento = d.id_documento");
    $stmtDetallesDocumentos->execute();
    $detallesDocumentos = $stmtDetallesDocumentos->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('Error al obtener los datos: ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lista de Ventas</title>
</head>
<body>
    <h1>Lista de Ventas</h1>
    <table>
        <thead>
            <tr>
                <th>ID Venta</th>
                <th>Fecha</th>
                <th>Usuario</th>
                <th>Vendedor</th>
                <th>Servicios</th>
                <th>Documentos</th>
                <th>Productos</th>
                <th>Saldo Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ventas as $venta): ?>
                <tr>
                    <td><?php echo $venta['id_venta']; ?></td>
                    <td><?php echo $venta['fecha']; ?></td>
                    <td><?php echo $venta['nombre_usuario']; ?></td>
                    <td><?php echo $venta['nombre_vendedor']; ?></td>
                    <td>
                        <?php foreach ($detallesServicios as $detalle): ?>
                            <?php if ($detalle['id_venta'] == $venta['id_venta']): ?>
                                <?php echo $detalle['nombre_servicio']; ?><br>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </td>
                    <td>
                        <?php foreach ($detallesDocumentos as $detalle): ?>
                            <?php if ($detalle['id_venta'] == $venta['id_venta']): ?>
                                <?php echo $detalle['nombre_documento']; ?><br>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </td>
                    <td>
                        <?php foreach ($detallesProductos as $detalle): ?>
                            <?php if ($detalle['id_venta'] == $venta['id_venta']): ?>
                                <?php echo $detalle['nombre_producto']; ?> (Cantidad: <?php echo $detalle['cantidad']; ?>)<br>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </td>
                    <td><?php echo $venta['saldo_total']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

<?php include '../includes/funciones.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle de Ventas por Producto</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <div class="container">
        <?php include '../menu.php'; ?>
        <h1>Detalle de Ventas por Producto</h1>
        <a href="pdf_detalle_ventas_producto.php" class="btn btn-danger">Descargar PDF</a>
        <?php
        $sql = "SELECT p.nombre AS producto_nombre, 
                       p.categoria,
                       v.fecha_venta,
                       c.nombre AS cliente_nombre,
                       c.apellido AS cliente_apellido,
                       v.cantidad,
                       v.precio_unitario,
                       v.total
                FROM ventas v
                JOIN productos p ON v.id_producto = p.id_producto
                JOIN clientes c ON v.id_cliente = c.id_cliente
                ORDER BY p.nombre, v.fecha_venta DESC";
        $result = $conn->query($sql);
       
        $current_producto = "";
        while ($row = $result->fetch_assoc()) {
            if ($current_producto != $row['producto_nombre']) {
                if ($current_producto != "") echo "</table>";
                echo "<h2>{$row['producto_nombre']} ({$row['categoria']})</h2>";
                echo "<table>
                        <tr>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Total</th>
                        </tr>";
                $current_producto = $row['producto_nombre'];
            }
            echo "<tr>
                    <td>{$row['fecha_venta']}</td>
                    <td>{$row['cliente_nombre']} {$row['cliente_apellido']}</td>
                    <td>{$row['cantidad']}</td>
                    <td>$".number_format($row['precio_unitario'], 2)."</td>
                    <td>$".number_format($row['total'], 2)."</td>
                </tr>";
        }
        if ($current_producto != "") echo "</table>";
        ?>
    </div>
</body>
</html>
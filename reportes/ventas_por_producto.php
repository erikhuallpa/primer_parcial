<?php include '../includes/funciones.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ventas por Producto</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <div class="container">
        <?php include '../menu.php'; ?>
        <h1>Ventas por Producto</h1>
        <a href="pdf_ventas_por_producto.php" class="btn btn-danger">Descargar PDF</a>
        <?php
        $sql = "SELECT p.nombre AS producto_nombre, 
                       SUM(v.cantidad) AS total_vendido, 
                       SUM(v.total) AS ingresos_totales
                FROM ventas v
                JOIN productos p ON v.id_producto = p.id_producto
                GROUP BY p.id_producto
                ORDER BY total_vendido DESC";
        $result = $conn->query($sql);
       
        echo "<table>
                <tr>
                    <th>Producto</th>
                    <th>Unidades Vendidas</th>
                    <th>Ingresos Totales</th>
                </tr>";
        
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['producto_nombre']}</td>
                    <td>{$row['total_vendido']}</td>
                    <td>$".number_format($row['ingresos_totales'], 2)."</td>
                </tr>";
        }
        echo "</table>";
        ?>
    </div>
</body>
</html>
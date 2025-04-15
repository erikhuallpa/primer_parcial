<?php include '../includes/funciones.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clientes por Compras</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <div class="container">
        <?php include '../menu.php'; ?>
        <h1>Clientes por Volumen de Compras</h1>
        <a href="pdf_clientes_por_compras.php" class="btn btn-danger">Descargar PDF</a>
        <table>
            <tr>
                <th>Cliente</th>
                <th>Cantidad de Compras</th>
                <th>Total Gastado</th>
            </tr>
            <?php
            $sql = "SELECT c.nombre, c.apellido, 
                           COUNT(v.id_venta) AS compras, 
                           SUM(v.total) AS total_gastado
                    FROM ventas v
                    JOIN clientes c ON v.id_cliente = c.id_cliente
                    GROUP BY c.id_cliente
                    ORDER BY total_gastado DESC";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['nombre']} {$row['apellido']}</td>
                        <td>{$row['compras']}</td>
                        <td>$".number_format($row['total_gastado'], 2)."</td>
                    </tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
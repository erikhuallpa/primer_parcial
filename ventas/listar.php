<?php include '../includes/funciones.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Ventas</title>    
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <div class="container">
        <?php include '../menu.php'; ?>
        <h1>Ventas Registradas</h1>
        <a href="crear.php" class="btn btn-success">Nueva Venta</a>
        <table>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Producto</th>
                <th>Fecha</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
            <?php
            $result = listarVentas();
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id_venta']}</td>
                        <td>{$row['cliente_nombre']} {$row['cliente_apellido']}</td>
                        <td>{$row['producto_nombre']}</td>
                        <td>{$row['fecha_venta']}</td>
                        <td>{$row['cantidad']}</td>
                        <td>\${$row['precio_unitario']}</td>
                        <td>\${$row['total']}</td>
                        <td>
                            <a href='eliminar.php?id={$row['id_venta']}' class='btn btn-danger'>Eliminar</a>
                        </td>
                    </tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
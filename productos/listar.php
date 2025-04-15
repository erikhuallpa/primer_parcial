<?php include '../includes/funciones.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Productos</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <div class="container">
        <?php include '../menu.php'; ?>
        <h1>Productos Disponibles</h1>
        <a href="crear.php" class="btn btn-success">Nuevo Producto</a>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Categoría</th>
                <th>Acciones</th>
            </tr>
            <?php
            $result = listarProductos();
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id_producto']}</td>
                        <td>{$row['nombre']}</td>
                        <td>".substr($row['descripcion'], 0, 50)."...</td>
                        <td>\${$row['precio']}</td>
                        <td>{$row['stock']}</td>
                        <td>{$row['categoria']}</td>
                        <td>
                            <a href='editar.php?id={$row['id_producto']}' class='btn btn-warning'>Editar</a>
                            <a href='eliminar.php?id={$row['id_producto']}' class='btn btn-danger'>Eliminar</a>
                        </td>
                    </tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
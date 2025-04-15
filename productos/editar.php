<?php
include '../includes/funciones.php';

if (!isset($_GET['id'])) {
    header("Location: listar.php");
    exit();
}

$id = $_GET['id'];
$producto = obtenerProducto($id);

if (!$producto) {
    header("Location: listar.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $categoria = $_POST['categoria'];
   
    if (actualizarProducto($id, $nombre, $descripcion, $precio, $stock, $categoria)) {
        header("Location: listar.php");
        exit();
    } else {
        $error = "Error al actualizar el producto";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <div class="container">
        <?php include '../menu.php'; ?>
        <h1>Editar Producto</h1>
        <?php if (isset($error)) echo "<p style='color:red'>$error</p>"; ?>
        <form method="POST">
            <div class="form-group">
                <label>Nombre:</label>
                <input type="text" name="nombre" value="<?= $producto['nombre'] ?>" required>
            </div>
            <div class="form-group">
                <label>Descripción:</label>
                <textarea name="descripcion"><?= $producto['descripcion'] ?></textarea>
            </div>
            <div class="form-group">
                <label>Precio:</label>
                <input type="number" step="0.01" name="precio" value="<?= $producto['precio'] ?>" required>
            </div>
            <div class="form-group">
                <label>Stock:</label>
                <input type="number" name="stock" value="<?= $producto['stock'] ?>" required>
            </div>
            <div class="form-group">
                <label>Categoría:</label>
                <input type="text" name="categoria" value="<?= $producto['categoria'] ?>">
            </div>
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="listar.php" class="btn">Cancelar</a>
        </form>
    </div>
</body>
</html>
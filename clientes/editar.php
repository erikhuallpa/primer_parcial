<?php
include '../includes/funciones.php';

if (!isset($_GET['id'])) {
    header("Location: listar.php");
    exit();
}

$id = $_GET['id'];
$cliente = obtenerCliente($id);

if (!$cliente) {
    header("Location: listar.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
   
    if (actualizarCliente($id, $nombre, $apellido, $email, $telefono, $direccion)) {
        header("Location: listar.php");
        exit();
    } else {
        $error = "Error al actualizar el cliente";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <div class="container">
        <?php include '../menu.php'; ?>
        <h1>Editar Cliente</h1>
        <?php if (isset($error)) echo "<p style='color:red'>$error</p>"; ?>
        <form method="POST">
            <div class="form-group">
                <label>Nombre:</label>
                <input type="text" name="nombre" value="<?= $cliente['nombre'] ?>" required>
            </div>
            <div class="form-group">
                <label>Apellido:</label>
                <input type="text" name="apellido" value="<?= $cliente['apellido'] ?>" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" value="<?= $cliente['email'] ?>" required>
            </div>
            <div class="form-group">
                <label>Teléfono:</label>
                <input type="text" name="telefono" value="<?= $cliente['telefono'] ?>">
            </div>
            <div class="form-group">
                <label>Dirección:</label>
                <textarea name="direccion"><?= $cliente['direccion'] ?></textarea>
            </div>
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="listar.php" class="btn">Cancelar</a>
        </form>
    </div>
</body>
</html>
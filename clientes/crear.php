<?php
include '../includes/funciones.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
   
    if (crearCliente($nombre, $apellido, $email, $telefono, $direccion)) {
        header("Location: listar.php");
        exit();
    } else {
        $error = "Error al crear el cliente";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Cliente</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <div class="container">
        <?php include '../menu.php'; ?>
        <h1>Nuevo Cliente</h1>
        <?php if (isset($error)) echo "<p style='color:red'>$error</p>"; ?>
        <form method="POST">
            <div class="form-group">
                <label>Nombre:</label>
                <input type="text" name="nombre" required>
            </div>
            <div class="form-group">
                <label>Apellido:</label>
                <input type="text" name="apellido" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Teléfono:</label>
                <input type="text" name="telefono">
            </div>
            <div class="form-group">
                <label>Dirección:</label>
                <textarea name="direccion"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="listar.php" class="btn">Cancelar</a>
        </form>
    </div>
</body>
</html>
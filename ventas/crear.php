<?php
include '../includes/funciones.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_cliente = $_POST['id_cliente'];
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];
    $precio_unitario = $_POST['precio_unitario'];
   
    if (crearVenta($id_cliente, $id_producto, $cantidad, $precio_unitario)) {
        // Actualizar el stock del producto
        actualizarStockProducto($id_producto, $cantidad);
        header("Location: listar.php");
        exit();
    } else {
        $error = "Error al registrar la venta";
    }
}

$clientes = listarClientes();
$productos = listarProductos();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Venta</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <div class="container">
        <?php include '../menu.php'; ?>
        <h1>Registrar Venta</h1>
        <?php if (isset($error)) echo "<p style='color:red'>$error</p>"; ?>
        <form method="POST">
            <div class="form-group">
                <label>Cliente:</label>
                <select name="id_cliente" required>
                    <option value="">Seleccione un cliente</option>
                    <?php while ($cliente = $clientes->fetch_assoc()): ?>
                        <option value="<?= $cliente['id_cliente'] ?>">
                            <?= $cliente['nombre'] ?> <?= $cliente['apellido'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Producto:</label>
                <select name="id_producto" id="producto" required>
                    <option value="">Seleccione un producto</option>
                    <?php while ($producto = $productos->fetch_assoc()): ?>
                        <option value="<?= $producto['id_producto'] ?>" 
                                data-precio="<?= $producto['precio'] ?>"
                                data-stock="<?= $producto['stock'] ?>">
                            <?= $producto['nombre'] ?> (Stock: <?= $producto['stock'] ?>)
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Cantidad:</label>
                <input type="number" name="cantidad" id="cantidad" min="1" required>
                <span id="stock-disponible" style="color: #666;"></span>
            </div>
            <div class="form-group">
                <label>Precio Unitario:</label>
                <input type="number" step="0.01" name="precio_unitario" id="precio_unitario" required>
            </div>
            <div class="form-group">
                <label>Total:</label>
                <input type="text" id="total" readonly>
            </div>
            <button type="submit" class="btn btn-success">Registrar</button>
            <a href="listar.php" class="btn">Cancelar</a>
        </form>
    </div>

    <script>
        // Script para calcular total y validar stock
        document.getElementById('producto').addEventListener('change', function() {
            const precio = this.options[this.selectedIndex].getAttribute('data-precio');
            const stock = this.options[this.selectedIndex].getAttribute('data-stock');
            document.getElementById('precio_unitario').value = precio;
            document.getElementById('stock-disponible').textContent = `Stock disponible: ${stock}`;
            calcularTotal();
        });

        document.getElementById('cantidad').addEventListener('input', function() {
            calcularTotal();
        });

        function calcularTotal() {
            const cantidad = parseFloat(document.getElementById('cantidad').value) || 0;
            const precio = parseFloat(document.getElementById('precio_unitario').value) || 0;
            document.getElementById('total').value = '$' + (cantidad * precio).toFixed(2);
        }
    </script>
</body>
</html>
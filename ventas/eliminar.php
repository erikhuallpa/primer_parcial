<?php
include '../includes/funciones.php';

if (!isset($_GET['id'])) {
    header("Location: listar.php");
    exit();
}

$id = $_GET['id'];

// Obtener información de la venta para actualizar el stock
$venta = obtenerVenta($id);
if ($venta) {
    // Restaurar el stock del producto
    actualizarStockProducto($venta['id_producto'], -$venta['cantidad']);
}

if (eliminarVenta($id)) {
    header("Location: listar.php");
    exit();
} else {
    die("Error al eliminar la venta");
}
?>
<?php
include 'conexion.php';

// Funciones para Clientes
function listarClientes() {
    global $conn;
    $sql = "SELECT * FROM clientes";
    return $conn->query($sql);
}

function obtenerCliente($id) {
    global $conn;
    $sql = "SELECT * FROM clientes WHERE id_cliente = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function crearCliente($nombre, $apellido, $email, $telefono, $direccion) {
    global $conn;
    $sql = "INSERT INTO clientes (nombre, apellido, email, telefono, direccion) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nombre, $apellido, $email, $telefono, $direccion);
    return $stmt->execute();
}

function actualizarCliente($id, $nombre, $apellido, $email, $telefono, $direccion) {
    global $conn;
    $sql = "UPDATE clientes SET nombre = ?, apellido = ?, email = ?, telefono = ?, direccion = ? WHERE id_cliente = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $nombre, $apellido, $email, $telefono, $direccion, $id);
    return $stmt->execute();
}

function eliminarCliente($id) {
    global $conn;
    $sql = "DELETE FROM clientes WHERE id_cliente = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

// Funciones para Productos
function listarProductos() {
    global $conn;
    $sql = "SELECT * FROM productos";
    return $conn->query($sql);
}

function obtenerProducto($id) {
    global $conn;
    $sql = "SELECT * FROM productos WHERE id_producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function crearProducto($nombre, $descripcion, $precio, $stock, $categoria) {
    global $conn;
    $sql = "INSERT INTO productos (nombre, descripcion, precio, stock, categoria) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdis", $nombre, $descripcion, $precio, $stock, $categoria);
    return $stmt->execute();
}

function actualizarProducto($id, $nombre, $descripcion, $precio, $stock, $categoria) {
    global $conn;
    $sql = "UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, stock = ?, categoria = ? WHERE id_producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdisi", $nombre, $descripcion, $precio, $stock, $categoria, $id);
    return $stmt->execute();
}

function eliminarProducto($id) {
    global $conn;
    $sql = "DELETE FROM productos WHERE id_producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

// Funciones para Ventas
function crearVenta($id_cliente, $id_producto, $cantidad, $precio_unitario) {
    global $conn;
    $sql = "INSERT INTO ventas (id_cliente, id_producto, cantidad, precio_unitario) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiid", $id_cliente, $id_producto, $cantidad, $precio_unitario);
    return $stmt->execute();
}

function listarVentas() {
    global $conn;
    $sql = "SELECT v.id_venta, c.nombre as cliente_nombre, c.apellido as cliente_apellido, 
                   p.nombre as producto_nombre, v.fecha_venta, v.cantidad, 
                   v.precio_unitario, v.total 
            FROM ventas v 
            JOIN clientes c ON v.id_cliente = c.id_cliente 
            JOIN productos p ON v.id_producto = p.id_producto";
    return $conn->query($sql);
}

function obtenerVenta($id) {
    global $conn;
    $sql = "SELECT v.*, c.nombre as cliente_nombre, c.apellido as cliente_apellido, 
                   p.nombre as producto_nombre, p.descripcion as producto_descripcion
            FROM ventas v 
            JOIN clientes c ON v.id_cliente = c.id_cliente 
            JOIN productos p ON v.id_producto = p.id_producto
            WHERE v.id_venta = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function eliminarVenta($id) {
    global $conn;
    $sql = "DELETE FROM ventas WHERE id_venta = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

// Función adicional para actualizar el stock después de una venta
function actualizarStockProducto($id_producto, $cantidad_vendida) {
    global $conn;
    $sql = "UPDATE productos SET stock = stock - ? WHERE id_producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $cantidad_vendida, $id_producto);
    return $stmt->execute();
}
?>
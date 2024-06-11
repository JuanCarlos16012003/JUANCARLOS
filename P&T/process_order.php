<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $producto_id = $_POST['producto'];
    $cantidad = $_POST['cantidad'];
    $comentarios = $_POST['comentarios'];
    
    // Conexión a la base de datos
    $conn = new mysqli("localhost", "root", "", "tienda");
    
    // Verificar la conexión
    if ($conn->connect_error) {
        header("Location: error.php");
        exit();
    }
    
    // Obtener la información del producto
    $sql = "SELECT descripcion, precio FROM productos WHERE id = $producto_id";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $descripcion = $row['descripcion'];
        $precio = $row['precio'];
        $total = $precio * $cantidad;
        
        // Insertar el pedido en la tabla 'pedidos'
        $sql = "INSERT INTO pedidos (nombre, email, direccion, telefono, total, fechas) VALUES ('$nombre', '$email', '$direccion', '$telefono', $total, NOW())";
        
        if ($conn->query($sql) === TRUE) {
            $pedido_id = $conn->insert_id;
            
            // Insertar los detalles del pedido en la tabla 'pedido_detalles'
            $sql = "INSERT INTO pedido_detalles (pedido_id, descripcion, precio) VALUES ($pedido_id, '$descripcion', $precio)";
            
            if ($conn->query($sql) === TRUE) {
                header("Location: success.php");
                exit();
            } else {
                header("Location: error.php");
                exit();
            }
        } else {
            header("Location: error.php");
            exit();
        }
    } else {
        header("Location: error.php");
        exit();
    }
    
    $conn->close();
}
?>



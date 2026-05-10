<?php
include("config/conexion.php");

$insertado = false;
$error = "";

if(isset($_POST["enviar"])){

    $nombre = trim($_POST["nombre"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $tipo_usuario = $_POST["tipo_usuario"];

    if($nombre != "" && $email != "" && $password != "" && $tipo_usuario != ""){

        $sql = "INSERT INTO usuarios (nombre, email, password, tipo_usuario)
                VALUES ('$nombre', '$email', '$password', '$tipo_usuario')";

        $resultado = mysqli_query($conexion, $sql);

        if($resultado){
            $insertado = true;
        } else {
            $error = "Error al crear usuario: " . mysqli_error($conexion);
        }

    } else {
        $error = "Todos los campos son obligatorios.";
    }
}
?>

<html>
<head>
    <title>Registro</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="admin-form-container">

    <h1 class="admin-form-title">
        Registro de usuario
    </h1>

    <?php if($insertado): ?>

        <p class="admin-success">
            Usuario creado correctamente
        </p>

        <br>

        <a class="admin-btn" href="auth/login.php">
            Ir al login
        </a>

    <?php else: ?>

        <?php if($error != ""): ?>
            <p class="admin-error">
                <?php echo $error; ?>
            </p>
            <br>
        <?php endif; ?>

        <form method="POST" class="admin-form">

            <label>Nombre:</label>
            <input type="text" name="nombre" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <label>Tipo de usuario:</label>
            <select name="tipo_usuario">
                <option value="comprador">Comprador</option>
                <option value="vendedor">Vendedor</option>
            </select>

            <br><br>

            <input class="admin-btn" type="submit" name="enviar" value="Registrarse">

        </form>

    <?php endif; ?>

    <br>

    <a class="admin-back" href="auth/login.php">
        ← Volver al login
    </a>

</div>

</body>
</html>

<?php mysqli_close($conexion); ?>
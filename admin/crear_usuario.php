<?php

session_start();

if(!isset($_SESSION["user_id"]) || 
   $_SESSION["tipo_usuario"] != "admin"){

    die("
        Acceso no autorizado.
        <br><br>
        <a href='../auth/login.php'>
            Login
        </a>
    ");
}

include("../config/conexion.php");

$insertado = false;

// Procesar formulario
if(isset($_POST["enviar"])){

    $nombre = trim(strip_tags($_POST["nombre"]));
    $email = trim(strip_tags($_POST["email"]));
    $password = trim(strip_tags($_POST["password"]));
    $tipo_usuario = trim(strip_tags($_POST["tipo_usuario"]));


    if($nombre != "" &&
       $email != "" &&
       $password != "" &&
       $tipo_usuario != ""){


        $sql = "INSERT INTO usuarios
                (nombre, email, password, tipo_usuario)

                VALUES

                ('$nombre',
                 '$email',
                 '$password',
                 '$tipo_usuario')";


        $resultado = mysqli_query($conexion, $sql);


        if($resultado){

            $insertado = true;

        }else{

            echo "<p>Error: "
                 . mysqli_error($conexion)
                 . "</p>";
        }

    }else{

        echo "<p>Todos los campos son obligatorios.</p>";
    }
}
?>

<html>
<head>
    <title>Crear usuario</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="admin-form-container">

    <h1 class="admin-form-title">
    Añadir usuario
    </h1>


    <?php if($insertado): ?>

        <p class="admin-success">
            Usuario insertado correctamente.
        </p>

        <p>
            <a href="listar_usuarios.php">
                Ver listado
            </a>
        </p>

        <p>
            <a href="crear_usuario.php">
                Añadir otro usuario
            </a>
        </p>


    <?php else: ?>


    <form method="POST" class="admin-form">

        <label>Nombre:</label>
        <input type="text" name="nombre" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Password:</label>
        <input type="text" name="password" required>

        <label>Tipo usuario:</label>
        <select name="tipo_usuario">
            <option value="cliente">Cliente</option>
            <option value="admin">Administrador</option>
        </select>

        <input
            class="admin-btn"
            type="submit"
            name="enviar"
            value="Guardar usuario">

    </form>

    <?php endif; ?>



    <a class="admin-back" href="../auth/panel.php">
        ← Volver al menú
    </a>

</div>    
</body>
</html>

<?php mysqli_close($conexion); ?>
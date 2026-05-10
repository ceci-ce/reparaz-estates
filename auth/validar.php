<?php

session_start();
include("../config/conexion.php");

// Comprobación básica de POST
if(!isset($_POST["email"]) || !isset($_POST["password"])){

    die("
        <div class='admin-form-container'>
            <p class='admin-error'>Acceso incorrecto al sistema.</p>
            <a class='admin-back' href='login.php'>Volver</a>
        </div>
    ");
}

$email = trim(strip_tags($_POST["email"]));
$password = trim(strip_tags($_POST["password"]));


// Buscar usuario
$sql = "SELECT * FROM usuarios
        WHERE email = '$email'
        AND password = '$password'";

$consulta = mysqli_query($conexion, $sql);

$nfilas = mysqli_num_rows($consulta);


// Si existe usuario
if($nfilas == 1){

    $fila = mysqli_fetch_assoc($consulta);

    // Guardar sesión para TODOS los usuarios
    $_SESSION["user_id"] = $fila["usuario_id"];
    $_SESSION["nombre"] = $fila["nombre"];
    $_SESSION["tipo_usuario"] = $fila["tipo_usuario"];


    // Redirección según tipo de usuario
    if($fila["tipo_usuario"] == "admin"){

        header("Location: ../admin/listar_pisos.php");
        exit;

    } elseif($fila["tipo_usuario"] == "comprador"){

        header("Location: ../cliente/panel.php");
        exit;

    } elseif($fila["tipo_usuario"] == "vendedor"){

        header("Location: ../vendedor/panel.php");
        exit;

    } else {

        echo "
        <div class='admin-form-container'>
            <p class='admin-error'>Tipo de usuario no válido.</p>
            <br>
            <a class='admin-back' href='login.php'>Volver</a>
        </div>";
    }

} else {

    echo "
    <div class='admin-form-container'>
        <p class='admin-error'>Usuario o contraseña incorrectos.</p>
        <br>
        <a class='admin-back' href='login.php'>Volver</a>
    </div>";
}

mysqli_close($conexion);

?>
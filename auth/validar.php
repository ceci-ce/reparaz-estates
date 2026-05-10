<?php

session_start();
include("../config/conexion.php");

if($_SERVER["REQUEST_METHOD"] !== "POST"){

    die("
        <div class='admin-form-container'>
            <p class='admin-error'>Acceso incorrecto al sistema.</p>
            <a class='admin-back' href='login.php'>Volver</a>
        </div>
    ");
}

$email = trim(strip_tags($_POST["email"]));
$password = trim(strip_tags($_POST["password"]));

$sql = "SELECT * FROM usuarios
        WHERE email = '$email'
        AND password = '$password'";

$consulta = mysqli_query($conexion, $sql);
$nfilas = mysqli_num_rows($consulta);

if($nfilas == 1){

    $fila = mysqli_fetch_assoc($consulta);

    // Guardar sesión
    $_SESSION["user_id"] = $fila["usuario_id"];
    $_SESSION["nombre"] = $fila["nombre"];
    $_SESSION["tipo_usuario"] = $fila["tipo_usuario"];

    // REDIRECCIÓN POR ROLES 
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
            <a class='admin-back' href='login.php'>Volver</a>
        </div>";
    }

} else {

    echo "
    <div class='admin-form-container'>
        <p class='admin-error'>Usuario o contraseña incorrectos.</p>
        <a class='admin-back' href='login.php'>Volver</a>
    </div>";
}

mysqli_close($conexion);

?>
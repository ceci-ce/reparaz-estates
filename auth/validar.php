<?php

session_start();
include("../config/conexion.php");

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


// Si existe
if($nfilas == 1){


    $fila = mysqli_fetch_assoc($consulta);


    // SOLO admins
    if($fila["tipo_usuario"] == "admin"){


        $_SESSION["user_id"] =
            $fila["usuario_id"];


        $_SESSION["nombre"] =
            $fila["nombre"];


        $_SESSION["tipo_usuario"] =
            $fila["tipo_usuario"];


        header("Location: panel.php");


    } else {

    echo "
    <div class='admin-form-container'>
        <p class='admin-error'>Acceso denegado. Solo administradores.</p>
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
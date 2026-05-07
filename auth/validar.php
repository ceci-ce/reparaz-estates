<?php

session_start();

include("../config/conexion.php");

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
        Acceso denegado.
        Solo administradores.
        <br><br>
        <a href='login.php'>Volver</a>";
    }


} else {

    echo "
    Usuario o contraseña incorrectos.
    <br><br>
    <a href='login.php'>Volver</a>";
}


mysqli_close($conexion);

?>
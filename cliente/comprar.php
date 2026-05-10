<?php

session_start();
include("../config/conexion.php");


if(!isset($_SESSION["user_id"]) || 
   $_SESSION["tipo_usuario"] != "comprador"){

    die("Acceso no autorizado");
}


if(!isset($_GET["id"])){

    die("Piso no válido");
}


$id_usuario = $_SESSION["user_id"];

$id = trim(strip_tags($_GET["id"]));


// Obtener precio del piso
$sql = "SELECT * FROM pisos
        WHERE piso_id = $id
        AND disponible = 1";

$consulta = mysqli_query($conexion, $sql);


if(mysqli_num_rows($consulta) != 1){

    die("Piso no disponible");
}


$fila = mysqli_fetch_assoc($consulta);

$precio = $fila["precio"];


// Registrar compra
$sql = "INSERT INTO compras
        (
            usuario_id,
            piso_id,
            precio_final
        )
        VALUES
        (
            $id_usuario,
            $id,
            $precio
        )";

$resultado = mysqli_query($conexion, $sql);


// Si se guardó, marcar vendido
if($resultado){

    $sql = "UPDATE pisos
            SET disponible = 0
            WHERE piso_id = $id";

    mysqli_query($conexion, $sql);
}

?>

<html>
<head>
    <title>Compra</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="admin-form-container">

    <?php if($resultado): ?>

        <h2 class="admin-success">
            Compra realizada con éxito
        </h2>

    <?php else: ?>

        <p class="admin-error">
            Error en la compra
        </p>

    <?php endif; ?>

    <br>

    <a class="admin-back" href="panel.php">
        Volver a pisos
    </a>

</div>

</body>
</html>

<?php mysqli_close($conexion); ?>
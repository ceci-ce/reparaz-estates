<?php

session_start();
include("../config/conexion.php");

if(!isset($_SESSION["user_id"]) || $_SESSION["tipo_usuario"] != "vendedor"){

    die("
        <div class='admin-form-container'>
            <p class='admin-error'>Acceso no autorizado</p>
            <a class='admin-back' href='../auth/login.php'>Login</a>
        </div>
    ");
}

$insertado = false;

if(isset($_POST["enviar"])){

    $titulo = trim($_POST["titulo"]);
    $descripcion = trim($_POST["descripcion"]);
    $calle = trim($_POST["calle"]);
    $numero = trim($_POST["numero"]);
    $metros = trim($_POST["metros"]);
    $precio = trim($_POST["precio"]);
    $zona = trim($_POST["zona"]);

    $usuario_id = $_SESSION["user_id"];

    if($titulo != "" && $calle != "" && $numero != "" && $metros != "" && $precio != ""){

        $sql = "INSERT INTO pisos
        (titulo, descripcion, calle, numero, metros, precio, zona, usuario_id, disponible)
        VALUES
        ('$titulo', '$descripcion', '$calle', '$numero', '$metros', '$precio', '$zona', '$usuario_id', 1)";

        $resultado = mysqli_query($conexion, $sql);

        if($resultado){
            $insertado = true;
        } else {
            echo "Error: " . mysqli_error($conexion);
        }

    } else {
        echo "Rellena los campos obligatorios";
    }
}

?>

<html>
<head>
    <title>Crear piso</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="admin-form-container">

    <h1 class="admin-form-title">
        Crear piso
    </h1>

    <?php if($insertado): ?>

        <p class="admin-success">Piso creado correctamente</p>
        <a class="admin-back" href="panel.php">Volver</a>

    <?php else: ?>

        <form method="POST" class="admin-form">

            <label>Título:</label>
            <input type="text" name="titulo">

            <label>Descripción:</label>
            <textarea name="descripcion"></textarea>

            <label>Calle:</label>
            <input type="text" name="calle">

            <label>Número:</label>
            <input type="number" name="numero">

            <label>Zona:</label>
            <input type="text" name="zona">

            <label>Metros:</label>
            <input type="number" name="metros">

            <label>Precio:</label>
            <input type="text" name="precio">

            <input class="admin-btn" type="submit" name="enviar" value="Publicar piso">

        </form>

    <?php endif; ?>

</div>

</body>
</html>

<?php mysqli_close($conexion); ?>
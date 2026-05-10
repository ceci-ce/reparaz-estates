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

if (isset($_POST["enviar"])) {

    $titulo = trim($_POST["titulo"]);
    $descripcion = trim($_POST["descripcion"]);
    $calle = trim($_POST["calle"]);
    $numero = trim($_POST["numero"]);
    $piso = trim($_POST["piso"]);
    $puerta = trim($_POST["puerta"]);
    $cp = trim($_POST["cp"]);
    $zona = trim($_POST["zona"]);
    $metros = trim($_POST["metros"]);
    $habitaciones = trim($_POST["habitaciones"]);
    $banos = trim($_POST["banos"]);
    $precio = trim($_POST["precio"]);
    $imagen = trim($_POST["imagen"]);

    if ($titulo != "" && $calle != "" && $numero != "" && $metros != "" && $precio != "") {

    $sql = "INSERT INTO pisos
    (
    titulo,
    descripcion,
    calle,
    numero,
    piso,
    puerta,
    cp,
    zona,
    metros,
    habitaciones,
    banos,
    precio,
    imagen
    )
    VALUES
    (
    '$titulo',
    '$descripcion',
    '$calle',
    '$numero',
    '$piso',
    '$puerta',
    '$cp',
    '$zona',
    '$metros',
    '$habitaciones',
    '$banos',
    '$precio',
    '$imagen'
    )";

        $resultado = mysqli_query($conexion, $sql);

        if ($resultado) {
            $insertado = true;
        } else {
            echo "<p class='admin-error'>Error: " . mysqli_error($conexion) . "</p>";
        }

    } else {
        echo "<p class='admin-error'>Todos los campos son obligatorios</p>";
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

<?php if ($insertado): ?>
    <p class="admin-success">Piso insertado correctamente</p>
    <a href="listar_pisos.php">Ver lista</a>
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

    <label>Piso:</label>
    <input type="number" name="piso">

    <label>Puerta:</label>
    <input type="text" name="puerta">

    <label>CP:</label>
    <input type="text" name="cp">

    <label>Zona:</label>
    <input type="text" name="zona">

    <label>Metros:</label>
    <input type="number" name="metros">

    <label>Habitaciones:</label>
    <input type="number" name="habitaciones">

    <label>Baños:</label>
    <input type="number" name="banos">

    <label>Precio:</label>
    <input type="text" name="precio">

    <label>Imagen:</label>
    <input type="text" name="imagen">

    <input
        class="admin-btn"
        type="submit"
        name="enviar"
        value="Guardar piso">
</form>

<?php endif; ?>

</div>
</body>
</html>

<?php mysqli_close($conexion); ?>
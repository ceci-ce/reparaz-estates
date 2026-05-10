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
            echo "Error: " . mysqli_error($conexion);
        }

    } else {
        echo "Todos los campos son obligatorios";
    }
}
?>

<html>
<head>
    <title>Crear piso</title>
</head>
<body>

<h1>Crear piso</h1>

<?php if ($insertado): ?>
    <p style="color:green;">Piso insertado correctamente</p>
    <a href="listar_pisos.php">Ver lista</a>
<?php else: ?>

<form method="POST">

    <label>Título:</label>
    <input type="text" name="titulo"><br><br>

    <label>Descripción:</label>
    <textarea name="descripcion"></textarea><br><br>

    <label>Calle:</label>
    <input type="text" name="calle"><br><br>

    <label>Número:</label>
    <input type="number" name="numero"><br><br>

    <label>Piso:</label>
    <input type="number" name="piso"><br><br>

    <label>Puerta:</label>
    <input type="text" name="puerta"><br><br>

    <label>CP:</label>
    <input type="text" name="cp"><br><br>

    <label>Zona:</label>
    <input type="text" name="zona"><br><br>

    <label>Metros:</label>
    <input type="number" name="metros"><br><br>

    <label>Habitaciones:</label>
    <input type="number" name="habitaciones"><br><br>

    <label>Baños:</label>
    <input type="number" name="banos"><br><br>

    <label>Precio:</label>
    <input type="text" name="precio"><br><br>

    <label>Imagen:</label>
    <input type="text" name="imagen"><br><br>

    <input type="submit" name="enviar" value="Guardar">
</form>

<?php endif; ?>

</body>
</html>

<?php mysqli_close($conexion); ?>
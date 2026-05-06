<?php
include("../config/conexion.php");

$insertado = false;

if (isset($_POST["enviar"])) {

    $titulo = trim($_POST["titulo"]);
    $calle = trim($_POST["calle"]);
    $numero = trim($_POST["numero"]);
    $metros = trim($_POST["metros"]);
    $precio = trim($_POST["precio"]);

    if ($titulo != "" && $calle != "" && $numero != "" && $metros != "" && $precio != "") {

        $sql = "INSERT INTO pisos (titulo, calle, numero, metros, precio)
                VALUES ('$titulo', '$calle', '$numero', '$metros', '$precio')";

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

    <label>Calle:</label>
    <input type="text" name="calle"><br><br>

    <label>Número:</label>
    <input type="number" name="numero"><br><br>

    <label>Metros:</label>
    <input type="number" name="metros"><br><br>

    <label>Precio:</label>
    <input type="text" name="precio"><br><br>

    <input type="submit" name="enviar" value="Guardar">
</form>

<?php endif; ?>

</body>
</html>

<?php mysqli_close($conexion); ?>
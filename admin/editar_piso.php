<?php
include("../config/conexion.php");

$mensaje = "";
$piso_encontrado = false;
$id = "";

// PASO 1: Buscar piso por ID
if(isset($_GET["id"])){

    $id = trim(strip_tags($_GET["id"]));

    $sql = "SELECT * FROM pisos WHERE piso_id = $id";

    $consulta = mysqli_query($conexion, $sql);

    $nfilas = mysqli_num_rows($consulta);

    if($nfilas == 1){

    $piso_encontrado = true;

    $fila = mysqli_fetch_assoc($consulta);

    $titulo = $fila["titulo"];
    $calle = $fila["calle"];
    $numero = $fila["numero"];
    $metros = $fila["metros"];
    $precio = $fila["precio"];

    }else{

    $mensaje = "No se encontró el piso con ID: $id";
    }
}

// PASO 2: Actualizar
if (isset($_POST["actualizar"])) {

    $id = trim(strip_tags($_POST["id"]));
    $titulo = trim(strip_tags($_POST["titulo"]));
    $calle = trim(strip_tags($_POST["calle"]));
    $numero = trim(strip_tags($_POST["numero"]));
    $metros = trim(strip_tags($_POST["metros"]));
    $precio = trim(strip_tags($_POST["precio"]));

    if ($titulo != "" && $calle != "" && $numero != "" && $metros != "" && $precio != "") {

        $sql = "UPDATE pisos
                SET titulo = '$titulo',
                    calle = '$calle',
                    numero = $numero,
                    metros = $metros,
                    precio = $precio
                WHERE piso_id = $id";

        $resultado = mysqli_query($conexion, $sql);

        if ($resultado) {

            $mensaje = "<p style='color:green;'>✅ Piso actualizado correctamente.</p>";

            $piso_encontrado = false;

        } else {

            $mensaje = "<p style='color:red;'>Error: ".mysqli_error($conexion)."</p>";
        }

    } else {

        $mensaje = "<p style='color:red;'>Todos los campos son obligatorios.</p>";
    }
}

?>

<html>
<head>
    <title>Editar piso</title>
</head>
<body>

    <h1>Editar piso</h1>

    <?php echo $mensaje; ?>

    <?php if (!$piso_encontrado && !isset($_POST["actualizar"])): ?>

        <form method="GET">

            <label>ID del piso:</label>

            <input type="number" name="id" required>

            <input type="submit" value="Buscar">

        </form>

    <?php endif; ?>


    <?php if ($piso_encontrado): ?>

        <form method="POST">

            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <label>Título:</label>
            <input type="text" name="titulo"
                   value="<?php echo $titulo; ?>" required><br><br>

            <label>Calle:</label>
            <input type="text" name="calle"
                   value="<?php echo $calle; ?>" required><br><br>

            <label>Número:</label>
            <input type="number" name="numero"
                   value="<?php echo $numero; ?>" required><br><br>

            <label>Metros:</label>
            <input type="number" name="metros"
                   value="<?php echo $metros; ?>" required><br><br>

            <label>Precio:</label>
            <input type="text" name="precio"
                   value="<?php echo $precio; ?>" required><br><br>

            <input type="submit"
                   name="actualizar"
                   value="Actualizar piso">

        </form>

    <?php endif; ?>

    <br>

    <a href="listar_pisos.php">Ver listado</a>

</body>
</html>

<?php mysqli_close($conexion); ?>
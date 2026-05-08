<?php

include("config/conexion.php");


// 1. Validar que venga el ID
if (!isset($_GET["id"]) || $_GET["id"] == "") {

    die("
        Error: no se ha especificado ningún piso.
        <br><br>
        <a href='index.php'>Volver al inicio</a>
    ");
}

$id = trim(strip_tags($_GET["id"]));


// 2. Validar que sea numérico
if (!is_numeric($id)) {

    die("
        Error: ID inválido.
        <br><br>
        <a href='index.php'>Volver al inicio</a>
    ");
}


// 3. Buscar piso en BD
$sql = "SELECT * FROM pisos WHERE piso_id = $id";

$consulta = mysqli_query($conexion, $sql);


// 4. Comprobar si existe resultado
if (!$consulta) {

    die("
        Error en la consulta.
        <br><br>
        " . mysqli_error($conexion)
    );
}


// 5. Obtener datos
$fila = mysqli_fetch_assoc($consulta);


// 6. Validar si existe el piso
if (!$fila) {

    die("
        Piso no encontrado.
        <br><br>
        <a href='index.php'>Volver al inicio</a>
    ");
}

?>


<html>
<head>
    <title>Detalle del piso</title>
</head>

<body>

    <h1>Detalle del piso</h1>

    <hr>


    <h2>
        <?php echo $fila["calle"]; ?>
        <?php echo $fila["numero"]; ?>
    </h2>


    <p>
        <strong>Metros:</strong>
        <?php echo $fila["metros"]; ?> m²
    </p>


    <p>
        <strong>Precio:</strong>
        <?php echo $fila["precio"]; ?> €
    </p>

    <br><br>

    <a href="comprar.php?id=<?php echo $fila["piso_id"]; ?>">
         Comprar piso
    </a>


    <p>
        <strong>CP:</strong>
        <?php echo $fila["cp"]; ?>
    </p>


    <p>
        <strong>Zona:</strong>
        <?php echo $fila["zona"]; ?>
    </p>


    <hr>


    <a href="index.php">
        ← Volver al listado
    </a>

</body>
</html>

<?php mysqli_close($conexion); ?>
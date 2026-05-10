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

    <link rel="stylesheet" href="css/style.css">

</head>


<body>


<header>

    <div class="container">

        <div class="logo">REPARAZ ESTATES</div>

    </div>

</header>



<div class="container">


    <div class="detalle">


        <h1>

            <?php echo $fila["calle"]; ?>

            <?php echo $fila["numero"]; ?>

        </h1>


        <div class="precio">

            <?php echo $fila["precio"]; ?> €

        </div>


        <p><strong>Metros:</strong> <?php echo $fila["metros"]; ?> m²</p>

        <p><strong>CP:</strong> <?php echo $fila["cp"]; ?></p>

        <p><strong>Zona:</strong> <?php echo $fila["zona"]; ?></p>


        <br>


        <a class="btn"

           href="comprar.php?id=<?php echo $fila["piso_id"]; ?>">

            Comprar piso

        </a>


        <br><br>


        <a href="index.php">← Volver</a>


    </div>


</div>



<footer>

    © 2026 Reparaz Estates

</footer>


</body>

</html>


<?php mysqli_close($conexion); ?>
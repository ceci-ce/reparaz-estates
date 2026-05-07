<?php
include("config/conexion.php");

// Traer últimos pisos
$sql = "SELECT * FROM pisos ORDER BY piso_id DESC LIMIT 6";
$consulta = mysqli_query($conexion, $sql);
?>

<html>
<head>
    <title>Reparaz Estates</title>
</head>

<body>

    <h1>Reparaz Estates</h1>

    <p>Encuentra tu hogar ideal</p>

    <hr>

    <h2>Últimos pisos</h2>

    <?php
    while($fila = mysqli_fetch_assoc($consulta)){
    ?>

        <div style="border:1px solid #ccc; padding:10px; margin:10px;">

            <h3>
                <?php echo $fila["calle"]; ?>
                <?php echo $fila["numero"]; ?>
            </h3>

            <p>
                <?php echo $fila["metros"]; ?> m²
            </p>

            <p>
                <?php echo $fila["precio"]; ?> €
            </p>

            <a href="detalle_piso.php?id=<?php echo $fila["piso_id"]; ?>">
                Ver detalles
            </a>

        </div>

    <?php
    }
    ?>

    <hr>

    <a href="auth/login.php">Admin</a>

</body>
</html>

<?php mysqli_close($conexion); ?>
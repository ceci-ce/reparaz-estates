<?php

include("config/conexion.php");


// Buscar todos los pisos
$sql = "SELECT * FROM pisos ORDER BY piso_id DESC";

$consulta = mysqli_query($conexion, $sql);


// Validar consulta
if (!$consulta) {

    die("
        Error en la consulta.
        <br><br>
        " . mysqli_error($conexion)
    );
}


// Número de resultados
$nfilas = mysqli_num_rows($consulta);

?>


<html>

<head>

    <title>Todos los pisos</title>

    <link rel="stylesheet" href="css/style.css">

</head>


<body>


<header>

    <div class="container">

        <div class="logo">

            REPARAZ ESTATES

        </div>

    </div>

</header>



<section class="hero">

    <h1>Catálogo de pisos</h1>

    <p>Encuentra tu próximo hogar</p>

</section>



<div class="container">


<?php if ($nfilas == 0): ?>


    <p>No hay pisos disponibles.</p>


<?php else: ?>


    <div class="grid">


    <?php

    for($i = 0; $i < $nfilas; $i++){

        $fila = mysqli_fetch_assoc($consulta);

    ?>


        <div class="card">


            <div class="card-body">


                <h3>

                    <?php echo $fila["calle"]; ?>

                    <?php echo $fila["numero"]; ?>

                </h3>


                <p>

                    <?php echo $fila["metros"]; ?> m²

                </p>


                <div class="precio">

                    <?php echo $fila["precio"]; ?> €

                </div>


                <a class="btn"

                   href="detalle_piso.php?id=<?php echo $fila["piso_id"]; ?>">

                    Ver detalles

                </a>


            </div>

        </div>


    <?php } ?>


    </div>


<?php endif; ?>


<br><br>


<a href="index.php">

    ← Volver al inicio

</a>


</div>



<footer>

    © 2026 Reparaz Estates

</footer>


</body>

</html>


<?php mysqli_close($conexion); ?>
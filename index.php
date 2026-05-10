<?php
include("config/conexion.php");

// Traer últimos pisos
$sql = "SELECT * FROM pisos ORDER BY piso_id DESC LIMIT 6";
$consulta = mysqli_query($conexion, $sql);
?>

<html>

<head>

    <title>Reparaz Estates</title>

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

    <h1>Encuentra tu hogar ideal</h1>

    <p>Propiedades exclusivas seleccionadas para ti</p>

</section>



<div class="container">


    <h2>Últimos pisos</h2>


    <div class="grid">


        <?php

        while($fila = mysqli_fetch_assoc($consulta)){

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


    <br><br>


    <a class="btn" href="pisos.php">

        Ver todos los pisos

    </a>


    <br><br>


    <a href="auth/login.php">

        Admin

    </a>


</div>



<footer>

    © 2026 Reparaz Estates

</footer>


</body>

</html>


<?php mysqli_close($conexion); ?>
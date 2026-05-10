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

// Consulta SELECT
$sql = "SELECT * FROM pisos ORDER BY piso_id DESC";
$consulta = mysqli_query($conexion, $sql);

// Número de filas
if(!$consulta){
    die("Error en la consulta: " . mysqli_error($conexion));
}

$nfilas = mysqli_num_rows($consulta);
?>

<html>
<head>
    <title>Listado de pisos</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="admin-form-container">

    <h1 class="admin-form-title">
        Listado de pisos
    </h1>

    <?php if ($nfilas == 0): ?>

        <p>No hay pisos en la base de datos.</p>
        <p><a class="admin-back" href="crear_piso.php">Añadir el primer piso</a></p>

    <?php else: ?>

    <table class="table">

        <tr>

            <th>ID</th>
            <th>Título</th>
            <th>Zona</th>
            <th>Hab.</th>
            <th>Baños</th>
            <th>Metros</th>
            <th>Precio (€)</th>
            <th>Estado</th>

        </tr>


        <?php

        for ($i = 0; $i < $nfilas; $i++) {

            $fila = mysqli_fetch_assoc($consulta);

            echo "<tr>";

            echo "<td>" . $fila["piso_id"] . "</td>";

            echo "<td>" . $fila["titulo"] . "</td>";

            echo "<td>" . $fila["zona"] . "</td>";

            echo "<td>" . $fila["habitaciones"] . "</td>";

            echo "<td>" . $fila["banos"] . "</td>";

            echo "<td>" . $fila["metros"] . " m²</td>";

            echo "<td>" .
                number_format($fila["precio"], 2)
                . " €</td>";


            if($fila["disponible"] == 1){

                echo "<td class='estado-disponible'>Disponible</td>";

            }else{

                echo "<td class='estado-vendido'>Vendido</td>";
            }

            echo "</tr>";
        }

        ?>

    </table>

    <?php endif; ?>

    <br>

    <a class="admin-back" href="crear_piso.php">Crear piso</a>

</div>
</body>
</html>

<?php mysqli_close($conexion); ?>
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
$nfilas = mysqli_num_rows($consulta);
?>

<html>
<head>
    <title>Listado de pisos</title>
</head>
<body>

    <h1>Listado de pisos</h1>

    <?php if ($nfilas == 0): ?>

        <p>No hay pisos en la base de datos.</p>
        <p><a href="crear_piso.php">Añadir el primer piso</a></p>

    <?php else: ?>

        <table border="1" cellpadding="5" cellspacing="0">

            <tr bgcolor="#CCCCCC">
                <th>ID</th>
                <th>Título</th>
                <th>Calle</th>
                <th>Número</th>
                <th>Metros</th>
                <th>Precio (€)</th>
            </tr>

            <?php

            for($i = 0; $i < $nfilas; $i++){

                $fila = mysqli_fetch_assoc($consulta);

                echo "<tr>";

                echo "<td>".$fila["piso_id"]."</td>";
                echo "<td>".$fila["titulo"]."</td>";
                echo "<td>".$fila["calle"]."</td>";
                echo "<td>".$fila["numero"]."</td>";
                echo "<td>".$fila["metros"]."</td>";
                echo "<td>".number_format($fila["precio"], 2)." €</td>";

                echo "</tr>";
            }

            ?>

        </table>

    <?php endif; ?>

    <br>

    <a href="crear_piso.php">Crear piso</a>

</body>
</html>

<?php mysqli_close($conexion); ?>
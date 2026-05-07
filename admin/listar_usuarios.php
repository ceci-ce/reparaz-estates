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
$sql = "SELECT * FROM usuarios ORDER BY usuario_id DESC";

$consulta = mysqli_query($conexion, $sql);


// Número de filas
$nfilas = mysqli_num_rows($consulta);
?>

<html>
<head>
    <title>Listado de usuarios</title>
</head>
<body>

    <h1>Listado de usuarios</h1>


    <?php if ($nfilas == 0): ?>

        <p>No hay usuarios en la base de datos.</p>

        <p>
            <a href="crear_usuario.php">
                Añadir el primer usuario
            </a>
        </p>

    <?php else: ?>


        <table border="1"
               cellpadding="5"
               cellspacing="0">


            <tr bgcolor="#CCCCCC">

                <th>ID</th>

                <th>Nombre</th>

                <th>Email</th>

                <th>Tipo</th>

                <th>Fecha</th>

            </tr>


            <?php

            for($i = 0; $i < $nfilas; $i++){

                $fila = mysqli_fetch_assoc($consulta);


                echo "<tr>";

                echo "<td>".$fila["usuario_id"]."</td>";

                echo "<td>".$fila["nombre"]."</td>";

                echo "<td>".$fila["email"]."</td>";

                echo "<td>".$fila["tipo_usuario"]."</td>";

                echo "<td>".$fila["fecha_registro"]."</td>";

                echo "</tr>";
            }

            ?>

        </table>


    <?php endif; ?>


    <br>


    <a href="crear_usuario.php">

        Crear usuario

    </a>

</body>
</html>

<?php mysqli_close($conexion); ?>
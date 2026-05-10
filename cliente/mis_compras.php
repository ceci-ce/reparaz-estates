<?php

session_start();
include("../config/conexion.php");


if(!isset($_SESSION["user_id"]) ||
   $_SESSION["tipo_usuario"] != "comprador"){

    die("Acceso no autorizado");
}


$id_usuario = $_SESSION["user_id"];


$sql = "SELECT compras.*, pisos.titulo

        FROM compras, pisos

        WHERE compras.piso_id = pisos.piso_id

        AND compras.usuario_id = $id_usuario

        ORDER BY compra_id DESC";


$consulta = mysqli_query($conexion, $sql);

?>

<html>
<head>
    <title>Mis compras</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="admin-form-container">

    <h1 class="admin-form-title">
        Mis compras
    </h1>


    <?php if(mysqli_num_rows($consulta) == 0): ?>

        <p>No has comprado pisos todavía.</p>

    <?php else: ?>

        <table>

            <tr>
                <th>Piso</th>
                <th>Precio</th>
                <th>Fecha</th>
            </tr>


            <?php while($fila = mysqli_fetch_assoc($consulta)): ?>

                <tr>

                    <td><?php echo $fila["titulo"]; ?></td>

                    <td>
                        <?php echo number_format($fila["precio_final"],2); ?> €
                    </td>

                    <td><?php echo $fila["fecha_compra"]; ?></td>

                </tr>

            <?php endwhile; ?>

        </table>

    <?php endif; ?>


    <br>

    <a class="admin-back" href="panel.php">
        Volver
    </a>

</div>

</body>
</html>

<?php mysqli_close($conexion); ?>
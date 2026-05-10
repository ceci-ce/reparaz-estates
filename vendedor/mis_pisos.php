<?php

session_start();
include("../config/conexion.php");

if(!isset($_SESSION["user_id"]) || $_SESSION["tipo_usuario"] != "vendedor"){
    die("Acceso no autorizado");
}

$id_usuario = $_SESSION["user_id"];

$sql = "SELECT * FROM pisos 
        WHERE usuario_id = $id_usuario
        ORDER BY piso_id DESC";

$consulta = mysqli_query($conexion, $sql);

?>

<html>
<head>
    <title>Mis pisos</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="admin-form-container">

    <h1 class="admin-form-title">Mis pisos</h1>

    <a class="admin-btn" href="crear_piso.php">Nuevo piso</a>

    <br><br>

    <?php if(mysqli_num_rows($consulta) == 0): ?>

        <p>No tienes pisos publicados.</p>

    <?php else: ?>

        <table>

            <tr>
                <th>Título</th>
                <th>Zona</th>
                <th>Precio</th>
                <th>Estado</th>
            </tr>

            <?php while($fila = mysqli_fetch_assoc($consulta)): ?>

                <tr>
                    <td><?= $fila["titulo"] ?></td>
                    <td><?= $fila["zona"] ?></td>
                    <td><?= number_format($fila["precio"],2) ?> €</td>

                    <td>
                        <?= $fila["disponible"] == 1 ? "Disponible" : "Vendido" ?>
                    </td>
                </tr>

            <?php endwhile; ?>

        </table>

    <?php endif; ?>

    <br>

    <a class="admin-back" href="../auth/panel.php">Volver</a>

</div>

</body>
</html>

<?php mysqli_close($conexion); ?>
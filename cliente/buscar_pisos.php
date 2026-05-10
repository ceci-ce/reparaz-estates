<?php

session_start();
include("../config/conexion.php");

if(!isset($_SESSION["user_id"]) || $_SESSION["tipo_usuario"] != "comprador"){
    die("Acceso no autorizado");
}

// todos los pisos disponibles
$sql = "SELECT * FROM pisos WHERE disponible = 1 ORDER BY piso_id DESC";
$consulta = mysqli_query($conexion, $sql);

?>

<html>
<head>
    <title>Buscar pisos</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="admin-form-container">

    <h1 class="admin-form-title">Buscar pisos</h1>

    <?php if(mysqli_num_rows($consulta) == 0): ?>

        <p>No hay pisos disponibles.</p>

    <?php else: ?>

        <table>

            <tr>
                <th>Título</th>
                <th>Zona</th>
                <th>Metros</th>
                <th>Precio</th>
                <th></th>
            </tr>

            <?php while($fila = mysqli_fetch_assoc($consulta)): ?>

                <tr>
                    <td><?= $fila["titulo"] ?></td>
                    <td><?= $fila["zona"] ?></td>
                    <td><?= $fila["metros"] ?> m²</td>
                    <td><?= number_format($fila["precio"],2) ?> €</td>

                    <td>
                        <a class="admin-btn"
                           href="comprar.php?id=<?= $fila["piso_id"] ?>">
                           Comprar
                        </a>
                    </td>
                </tr>

            <?php endwhile; ?>

        </table>

    <?php endif; ?>

</div>

</body>
</html>

<?php mysqli_close($conexion); ?>
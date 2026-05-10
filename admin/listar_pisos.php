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
    <!-- ALTA -->
    <a class="admin-btn" href="crear_piso.php">
        Crear piso
    </a>

    <br><br>

    <?php if ($nfilas == 0): ?>

        <p>No hay pisos en la base de datos.</p>
        <p><a class="admin-back" href="crear_piso.php">Añadir el primer piso</a></p>

    <?php else: ?>

    <table class="table">

        <tr>

            <th>ID</th>
            <th>Imagen</th>
            <th>Título</th>
            <th>Zona</th>
            <th>Hab.</th>
            <th>Baños</th>
            <th>Metros</th>
            <th>Precio (€)</th>
            <th>Estado</th>
            <th>Acciones</th>

        <?php while($fila = mysqli_fetch_assoc($consulta)): ?>

        <tr>

            <td><?= $fila["piso_id"] ?></td>
            <td>
                <img src="../img/<?php echo $fila["imagen"]; ?>" width="80">
            </td>
            <td><?= $fila["titulo"] ?></td>
            <td><?= $fila["zona"] ?></td>
            <td><?= $fila["habitaciones"] ?></td>
            <td><?= $fila["banos"] ?></td>
            <td><?= $fila["metros"] ?> m²</td>
            <td><?= number_format($fila["precio"],2) ?> €</td>

            <?php if($fila["disponible"] == 1): ?>
                <td class="estado-disponible">Disponible</td>
            <?php else: ?>
                <td class="estado-vendido">Vendido</td>
            <?php endif; ?>

            <!-- ACCIONES CRUD -->
            <td class="acciones">

                <!-- MODIFICAR -->
                <a class="btn-edit" href="editar_piso.php?id=<?= $fila["piso_id"] ?>">
                    Editar
                </a>

                <br>

                <!-- BORRAR -->
                <a class="btn-delete" href="borrar_piso.php?id=<?= $fila["piso_id"] ?>"
                   onclick="return confirm('¿Seguro que quieres eliminar este piso?')">
                    Borrar
                </a>

            </td>

        </tr>

        <?php endwhile; ?>

    </table>

    <?php endif; ?>

    <br>

    <a class="admin-back" href="listar_usuarios.php">
        Gestionar usuarios
    </a>

</div>
</body>
</html>

<?php mysqli_close($conexion); ?>
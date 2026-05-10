<?php

session_start();

include("../config/conexion.php");

if(!isset($_SESSION["user_id"])){

    die("
        <div class='admin-form-container'>
            <p class='admin-error'>Acceso no autorizado</p>
            <a class='admin-back' href='../auth/login.php'>Login</a>
        </div>
    ");
}

if($_SESSION["tipo_usuario"] != "vendedor"){
    header("Location: ../auth/login.php");
    exit;
}

$id_usuario = $_SESSION["user_id"];

// Pisos del vendedor
$sql = "SELECT * FROM pisos 
        WHERE usuario_id = $id_usuario
        ORDER BY piso_id DESC";

$consulta = mysqli_query($conexion, $sql);

?>

<html>
<head>
    <title>Panel vendedor</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="admin-form-container">

    <h1 class="admin-form-title">
        Panel vendedor
    </h1>

    <p class="admin-success">
        Bienvenido <?php echo $_SESSION["nombre"]; ?>
    </p>

    <br>

    <a class="admin-btn" href="crear_piso.php">
        Crear nuevo piso
    </a>

    <br><br>

    <a class="admin-btn" href="mis_pisos.php">
        Ver mis pisos
    </a>

    <a class="admin-btn" href="mis_ventas.php">
        Mis ventas
    </a>

    <br><br>

    <?php if(mysqli_num_rows($consulta) == 0): ?>

        <p>No has publicado pisos todavía.</p>

    <?php else: ?>

        <table>

            <tr>
                <th>Título</th>
                <th>Zona</th>
                <th>Metros</th>
                <th>Precio</th>
                <th>Estado</th>
            </tr>

            <?php while($fila = mysqli_fetch_assoc($consulta)): ?>

                <tr>
                    <td><?php echo $fila["titulo"]; ?></td>
                    <td><?php echo $fila["zona"]; ?></td>
                    <td><?php echo $fila["metros"]; ?> m²</td>
                    <td><?php echo number_format($fila["precio"],2); ?> €</td>

                    <?php if($fila["disponible"] == 1): ?>
                        <td class="estado-disponible">Disponible</td>
                    <?php else: ?>
                        <td class="estado-vendido">Vendido</td>
                    <?php endif; ?>
                </tr>

            <?php endwhile; ?>

        </table>

    <?php endif; ?>

    <br>

    <a class="admin-back" href="../auth/logout.php">
        Cerrar sesión
    </a>

</div>

</body>
</html>

<?php mysqli_close($conexion); ?>
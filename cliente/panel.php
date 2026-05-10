<?php

session_start();

include("../config/conexion.php");

// Protección: solo usuarios logueados
if(!isset($_SESSION["user_id"])){

    die("
        <div class='admin-form-container'>
            <p class='admin-error'>Acceso no autorizado</p>
            <a class='admin-back' href='../auth/login.php'>Login</a>
        </div>
    ");
}

// asegurar que no entre admin aquí
if($_SESSION["tipo_usuario"] == "admin"){
    header("Location: ../admin/listar_pisos.php");
    exit;
}

// Consulta pisos disponibles
$sql = "SELECT * FROM pisos WHERE disponible = 1 ORDER BY piso_id DESC";
$consulta = mysqli_query($conexion, $sql);

?>

<html>
<head>
    <title>Panel cliente</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="admin-form-container">

    <h1 class="admin-form-title">
        Bienvenido <?php echo $_SESSION["nombre"]; ?>
    </h1>

    <p class="admin-success">
        Zona de clientes (compradores)
    </p>

    <hr><br>

    <h2>Pisos disponibles</h2>

    <a class="admin-btn" href="mis_compras.php">
        Mis compras
    </a>

    <br><br>

    <?php if(mysqli_num_rows($consulta) == 0): ?>

        <p>No hay pisos disponibles.</p>

    <?php else: ?>

        <table>

            <tr>
                <th>Título</th>
                <th>Zona</th>
                <th>Metros</th>
                <th>Precio</th>
                <th>Comprar</th>
            </tr>

        <?php while($fila = mysqli_fetch_assoc($consulta)): ?>

        <tr>

            <td><?php echo $fila["titulo"]; ?></td>

            <td><?php echo $fila["zona"]; ?></td>

            <td><?php echo $fila["metros"]; ?> m²</td>

            <td><?php echo number_format($fila["precio"],2); ?> €</td>

            <td>

                <a class="admin-btn"
                href="comprar.php?id=<?php echo $fila["piso_id"]; ?>">

                    Comprar

                </a>

            </td>

        </tr>

        <?php endwhile; ?>

        </table>

    <?php endif; ?>

    <br><br>

    <a class="admin-back" href="../auth/logout.php">
        Cerrar sesión
    </a>

</div>

</body>
</html>

<?php mysqli_close($conexion); ?>
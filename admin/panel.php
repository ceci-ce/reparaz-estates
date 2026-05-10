<?php

session_start();

if(!isset($_SESSION["user_id"])){

    die("
        Acceso no autorizado.
        <br><br>
        <a href='login.php'>Login</a>
    ");
}

?>

<html>
<head>
    <title>Panel admin</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<div class="admin-panel">

    <h1 class="admin-title">
        Bienvenido <?php echo $_SESSION["nombre"]; ?>
    </h1>

    <p>
        Tipo: <strong><?php echo $_SESSION["tipo_usuario"]; ?></strong>
    </p>

    <hr><br>

    <h2>Administración</h2>

    <br>

    <a class="admin-btn" href="listar_pisos.php">
        Gestionar pisos
    </a>

    <br><br>

    <a class="admin-btn" href="listar_usuarios.php">
        Gestionar usuarios
    </a>

    <br><br>

    <a class="admin-back" href="../auth/logout.php">
        Cerrar sesión
    </a>

</div>

</body>
</html>
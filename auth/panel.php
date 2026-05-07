<?php

session_start();


// Protección
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
</head>
<body>

    <h1>

        Bienvenido

        <?php
        echo $_SESSION["nombre"];
        ?>

    </h1>


    <p>

        Tipo:

        <?php
        echo $_SESSION["tipo_usuario"];
        ?>

    </p>


    <hr>


    <h2>Administración</h2>


    <a href="../admin/listar_pisos.php">

        Gestionar pisos

    </a>

    <br><br>


    <a href="../admin/listar_usuarios.php">

        Gestionar usuarios

    </a>

    <br><br>


    <a href="logout.php">

        Cerrar sesión

    </a>

</body>
</html>
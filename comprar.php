<?php

session_start();

include("config/conexion.php");


// 1. Validar sesión
if (!isset($_SESSION["user_id"])) {

    die("
        Debes iniciar sesión para comprar.
        <br><br>
        <a href='auth/login.php'>Login</a>
    ");
}


// 2. Validar ID piso
if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {

    die("ID de piso inválido");
}

$piso_id = $_GET["id"];

$usuario_id = $_SESSION["user_id"];


// 3. Buscar piso
$sql = "SELECT * FROM pisos WHERE piso_id = $piso_id";

$consulta = mysqli_query($conexion, $sql);

$piso = mysqli_fetch_assoc($consulta);


// 4. Validar existencia
if (!$piso) {

    die("Piso no encontrado");
}


// 5. Precio final
$precio = $piso["precio"];


// 6. Insertar compra
$sql_insert = "INSERT INTO compras
(usuario_id, piso_id, precio_final)
VALUES
($usuario_id, $piso_id, $precio)";

$resultado = mysqli_query($conexion, $sql_insert);

?>


<html>
<head>
    <title>Compra realizada</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <h1>Compra realizada con éxito</h1>


    <p>
        Has comprado el piso:
        <?php echo $piso["calle"]; ?>
        <?php echo $piso["numero"]; ?>
    </p>


    <p>
        Precio:
        <?php echo $precio; ?> €
    </p>


    <hr>


    <a href="index.php">
        Volver al inicio
    </a>

</body>
</html>

<?php mysqli_close($conexion); ?>
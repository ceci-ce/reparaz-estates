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

$mensaje = "";
$piso_encontrado = false;
$id = "";

// PASO 1: Buscar piso por ID
if(isset($_GET["id"])){

    $id = trim(strip_tags($_GET["id"]));

    $sql = "SELECT * FROM pisos WHERE piso_id = $id";

    $consulta = mysqli_query($conexion, $sql);

    $nfilas = mysqli_num_rows($consulta);

    if($nfilas == 1){

    $piso_encontrado = true;

    $fila = mysqli_fetch_assoc($consulta);

    $titulo = $fila["titulo"];
    $calle = $fila["calle"];
    $numero = $fila["numero"];
    $metros = $fila["metros"];
    $precio = $fila["precio"];

    }else{

    $mensaje = "No se encontró el piso con ID: $id";
    }
}

// PASO 2: Actualizar
if (isset($_POST["actualizar"])) {

    $id = trim(strip_tags($_POST["id"]));
    $titulo = trim(strip_tags($_POST["titulo"]));
    $calle = trim(strip_tags($_POST["calle"]));
    $numero = trim(strip_tags($_POST["numero"]));
    $metros = trim(strip_tags($_POST["metros"]));
    $precio = trim(strip_tags($_POST["precio"]));

    if ($titulo != "" && $calle != "" && $numero != "" && $metros != "" && $precio != "") {

        $sql = "UPDATE pisos
                SET titulo = '$titulo',
                    calle = '$calle',
                    numero = $numero,
                    metros = $metros,
                    precio = $precio
                WHERE piso_id = $id";

        $resultado = mysqli_query($conexion, $sql);

        if ($resultado) {

            $mensaje = "<p style='color:green;'>✅ Piso actualizado correctamente.</p>";

            $piso_encontrado = false;

        } else {

            $mensaje = "<p style='color:red;'>Error: ".mysqli_error($conexion)."</p>";
        }

    } else {

        $mensaje = "<p style='color:red;'>Todos los campos son obligatorios.</p>";
    }
}

?>

<html>
<head>
    <title>Editar piso</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="admin-form-container">

    <h1 class="admin-form-title">
        Editar piso
    </h1>

    <?php if($mensaje != ""): ?>
        <p class="admin-error"><?php echo $mensaje; ?></p>
    <?php endif; ?>

    <?php if (!$piso_encontrado && !isset($_POST["actualizar"])): ?>

        <form method="GET" class="admin-form">

            <label>ID del piso:</label>
            <input type="number" name="id" required>

            <input class="admin-btn" type="submit" value="Buscar">

        </form>

    <?php endif; ?>


    <?php if ($piso_encontrado): ?>

        <form method="POST" class="admin-form">

            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <label>Título:</label>
            <input type="text" name="titulo"
                   value="<?php echo $titulo; ?>" required>

            <label>Calle:</label>
            <input type="text" name="calle"
                   value="<?php echo $calle; ?>" required>

            <label>Número:</label>
            <input type="number" name="numero"
                   value="<?php echo $numero; ?>" required>

            <label>Metros:</label>
            <input type="number" name="metros"
                   value="<?php echo $metros; ?>" required>

            <label>Precio:</label>
            <input type="text" name="precio"
                   value="<?php echo $precio; ?>" required>

            <input 
                   class="admin-btn"
                   type="submit"
                   name="actualizar"
                   value="Actualizar piso">

        </form>

    <?php endif; ?>

    <br>

    <a class="admin-back" href="listar_pisos.php">

</div>    
</body>
</html>

<?php mysqli_close($conexion); ?>
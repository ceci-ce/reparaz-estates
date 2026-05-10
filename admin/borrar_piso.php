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
$mostrar_busqueda = true;


// PASO 1: Buscar piso por ID
if (isset($_GET["id"]) && !isset($_POST["confirmar"])) {

    $id = trim(strip_tags($_GET["id"]));

    $sql = "SELECT * FROM pisos WHERE piso_id = $id";

    $consulta = mysqli_query($conexion, $sql);

    $nfilas = mysqli_num_rows($consulta);


    if ($nfilas == 1) {

        $fila = mysqli_fetch_assoc($consulta);

        $mostrar_busqueda = false;

        ?>

        <html>
        <head>
            <title>Eliminar piso</title>
        </head>
        <body>

            <h1>Eliminar piso</h1>

            <p>¿Seguro que quieres eliminar este piso?</p>

            <p><strong>ID:</strong> <?php echo $fila["piso_id"]; ?></p>

            <p><strong>Título:</strong> <?php echo $fila["titulo"]; ?></p>

            <p><strong>Calle:</strong> <?php echo $fila["calle"]; ?></p>

            <p><strong>Número:</strong> <?php echo $fila["numero"]; ?></p>

            <p><strong>Metros:</strong> <?php echo $fila["metros"]; ?></p>

            <p><strong>Precio:</strong>
                <?php echo $fila["precio"]; ?> €
            </p>


            <form method="POST">

                <input type="hidden"
                       name="id"
                       value="<?php echo $id; ?>">

                <input type="submit"
                       name="confirmar"
                       value="✅ Sí, eliminar">

            </form>

            <br>

            <a href="listar_pisos.php">
                ← Volver al listado
            </a>

        </body>
        </html>

        <?php

        mysqli_close($conexion);

        exit;

    } else {

        $mensaje =
            "<p style='color:red;'>No se encontró el piso con ID: $id</p>";
    }
}


// PASO 2: DELETE
if (isset($_POST["confirmar"])) {

    $id = trim(strip_tags($_POST["id"]));


    // Comprobar si tiene compras asociadas
    $sql_compras =
        "SELECT * FROM compras WHERE piso_id = $id";

    $consulta_compras =
        mysqli_query($conexion, $sql_compras);


    if (mysqli_num_rows($consulta_compras) > 0) {

        $mensaje =
            "<p style='color:red;'>
                No se puede eliminar este piso porque tiene compras registradas.
            </p>";

    } else {

        // DELETE
        $sql =
            "DELETE FROM pisos WHERE piso_id = $id";

        $resultado =
            mysqli_query($conexion, $sql);


        if ($resultado) {

            $mensaje =
                "<p style='color:green;'>
                    Piso eliminado correctamente.
                </p>";

            $mostrar_busqueda = false;

        } else {

            $mensaje =
                "<p style='color:red;'>
                    Error: "
                    . mysqli_error($conexion)
                    . "
                </p>";
        }
    }
}
?>

<html>
<head>
    <title>Eliminar piso</title>
</head>
<body>

    <h1>Eliminar piso</h1>

    <?php echo $mensaje; ?>


    <?php if ($mostrar_busqueda): ?>

        <form method="GET">

            <label>ID del piso:</label>

            <input type="number" name="id" required>

            <input type="submit" value="Buscar">

        </form>

    <?php endif; ?>


    <br>

    <a href="listar_pisos.php">
        ← Ver listado
    </a>

</body>
</html>

<?php mysqli_close($conexion); ?>
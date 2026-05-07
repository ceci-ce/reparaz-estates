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


// PASO 1: Buscar usuario
if (isset($_GET["id"]) &&
    !isset($_POST["confirmar"])) {


    $id = trim(strip_tags($_GET["id"]));


    // Protección admin principal
    if ($id == 1) {

        $mensaje =
            "<p style='color:red;'>
                No se puede eliminar el administrador principal.
            </p>";

    } else {


        $sql = "SELECT * FROM usuarios
                WHERE usuario_id = $id";


        $consulta = mysqli_query($conexion, $sql);

        $nfilas = mysqli_num_rows($consulta);



        if ($nfilas == 1) {

            $fila = mysqli_fetch_assoc($consulta);

            $mostrar_busqueda = false;

            ?>

            <html>
            <head>
                <title>Eliminar usuario</title>
            </head>
            <body>

                <h1>Eliminar usuario</h1>

                <p>
                    ¿Seguro que quieres eliminar este usuario?
                </p>


                <p>
                    <strong>ID:</strong>

                    <?php echo $fila["usuario_id"]; ?>
                </p>


                <p>
                    <strong>Nombre:</strong>

                    <?php echo $fila["nombre"]; ?>
                </p>


                <p>
                    <strong>Email:</strong>

                    <?php echo $fila["email"]; ?>
                </p>


                <p>
                    <strong>Tipo:</strong>

                    <?php echo $fila["tipo_usuario"]; ?>
                </p>



                <form method="POST">

                    <input type="hidden"
                           name="id"
                           value="<?php echo $id; ?>">


                    <input type="submit"
                           name="confirmar"
                           value="Sí, eliminar">

                </form>


                <br>


                <a href="listar_usuarios.php">

                    ← Volver al listado

                </a>

            </body>
            </html>

            <?php

            mysqli_close($conexion);

            exit;


        } else {

            $mensaje =
                "<p style='color:red;'>
                    No se encontró el usuario.
                </p>";
        }
    }
}



// PASO 2: DELETE
if (isset($_POST["confirmar"])) {


    $id = trim(strip_tags($_POST["id"]));


    $sql = "DELETE FROM usuarios
            WHERE usuario_id = $id";


    $resultado = mysqli_query($conexion, $sql);



    if ($resultado) {

        $mensaje =
            "<p style='color:green;'>
                Usuario eliminado correctamente.
            </p>";

        $mostrar_busqueda = false;

    } else {

        $mensaje =
            "<p style='color:red;'>
                Error: "
                . mysqli_error($conexion) .
            "</p>";
    }
}
?>


<html>
<head>
    <title>Eliminar usuario</title>
</head>
<body>

    <h1>Eliminar usuario</h1>


    <?php echo $mensaje; ?>


    <?php if ($mostrar_busqueda): ?>


        <form method="GET">

            <label>ID del usuario:</label>

            <input type="number"
                   name="id"
                   required>


            <input type="submit"
                   value="Buscar">


        </form>


    <?php endif; ?>


    <br>


    <a href="listar_usuarios.php">

        ← Ver listado

    </a>

</body>
</html>


<?php mysqli_close($conexion); ?>
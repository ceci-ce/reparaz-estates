<?php
include("../config/conexion.php");

$mensaje = "";
$usuario_encontrado = false;
$id = "";


// PASO 1: Buscar usuario
if (isset($_GET["id"])) {

    $id = trim(strip_tags($_GET["id"]));

    $sql = "SELECT * FROM usuarios 
            WHERE usuario_id = $id";

    $consulta = mysqli_query($conexion, $sql);

    $nfilas = mysqli_num_rows($consulta);


    if ($nfilas == 1) {

        $usuario_encontrado = true;

        $fila = mysqli_fetch_assoc($consulta);

        $nombre = $fila["nombre"];
        $email = $fila["email"];
        $password = $fila["password"];
        $tipo_usuario = $fila["tipo_usuario"];

    } else {

        $mensaje = "No se encontró el usuario con ID: $id";
    }
}



// PASO 2: Actualizar usuario
if (isset($_POST["actualizar"])) {

    $id = trim(strip_tags($_POST["id"]));

    $nombre = trim(strip_tags($_POST["nombre"]));

    $email = trim(strip_tags($_POST["email"]));

    $password = trim(strip_tags($_POST["password"]));

    $tipo_usuario = trim(strip_tags($_POST["tipo_usuario"]));



    if ($nombre != "" &&
        $email != "" &&
        $password != "" &&
        $tipo_usuario != "") {


        // Protección del admin principal
        if ($id == 1 && $tipo_usuario != "admin") {

            $mensaje =
                "<p style='color:red;'>
                    No se puede cambiar el tipo del administrador principal.
                </p>";

            $usuario_encontrado = true;


        } else {


            $sql = "UPDATE usuarios

                    SET nombre = '$nombre',
                        email = '$email',
                        password = '$password',
                        tipo_usuario = '$tipo_usuario'

                    WHERE usuario_id = $id";


            $resultado = mysqli_query($conexion, $sql);



            if ($resultado) {

                $mensaje =
                    "<p style='color:green;'>
                        Usuario actualizado correctamente.
                    </p>";

                $usuario_encontrado = false;

            } else {

                $mensaje =
                    "<p style='color:red;'>
                        Error al actualizar: "
                        . mysqli_error($conexion) .
                    "</p>";
            }
        }

    } else {

        $mensaje =
            "<p style='color:red;'>
                Todos los campos son obligatorios.
            </p>";
    }
}
?>


<html>
<head>
    <title>Editar usuario</title>
</head>
<body>

    <h1>Editar usuario</h1>


    <?php echo $mensaje; ?>



    <?php if (!$usuario_encontrado &&
              !isset($_POST["actualizar"])): ?>


        <!-- Buscar usuario -->


        <form method="GET">

            <label>ID del usuario:</label>

            <input type="number"
                   name="id"
                   required>

            <input type="submit"
                   value="Buscar">

        </form>


    <?php endif; ?>



    <?php if ($usuario_encontrado): ?>


        <!-- Formulario de edición -->


        <form method="POST">


            <input type="hidden"
                   name="id"
                   value="<?php echo $id; ?>">



            <label>Nombre:</label>

            <input type="text"
                   name="nombre"
                   value="<?php echo $nombre; ?>"
                   required>

            <br><br>



            <label>Email:</label>

            <input type="email"
                   name="email"
                   value="<?php echo $email; ?>"
                   required>

            <br><br>



            <label>Password:</label>

            <input type="text"
                   name="password"
                   value="<?php echo $password; ?>"
                   required>

            <br><br>



            <label>Tipo:</label>

            <select name="tipo_usuario">


                <option value="cliente"

                    <?php
                    if($tipo_usuario == "cliente"){
                        echo "selected";
                    }
                    ?>>

                    Cliente

                </option>



                <option value="admin"

                    <?php
                    if($tipo_usuario == "admin"){
                        echo "selected";
                    }
                    ?>>

                    Admin

                </option>


            </select>

            <br><br>



            <input type="submit"
                   name="actualizar"
                   value="Actualizar usuario">


        </form>


    <?php endif; ?>



    <br>

    <a href="listar_usuarios.php">

        ← Ver listado

    </a>

</body>
</html>


<?php mysqli_close($conexion); ?>
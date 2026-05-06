<?php

$conexion = mysqli_connect("localhost", "root", "", "inmobiliaria");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

?>
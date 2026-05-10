<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<div class="admin-form-container">

    <h1 class="admin-form-title">Acceso administración</h1>

    <form method="POST" action="validar.php" class="admin-form">

        <label>Email:</label>

        <input type="text" name="email" required>


        <label>Contraseña:</label>

        <input type="password" name="password" required>


        <input class="admin-btn" type="submit" value="Entrar">

    </form>

</div>

</body>
</html>
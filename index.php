<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recetario</title>
</head>
<body>
    <h1>Ingresar al recetario</h1>

    <form action="recetas.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br><br>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required>
        <br><br>

        <input type="submit" value="Entrar">
    </form>
</body>
</html>

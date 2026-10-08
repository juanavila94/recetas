<?php
$nombre = $_POST['nombre'] ?? '';
$apellido = $_POST['apellido'] ?? '';
$categoria = $_POST['categoria'] ?? '';
$dificultad = $_POST['dificultad'] ?? '';

$recetas = [
    'carne' => [
        'Básica' => ['Milanesas de carne', 'Hamburguesas caseras', 'Carne al horno'],
        'Intermedia' => ['Asado con papas', 'Albóndigas con salsa', 'Carne rellena']
    ],
    'pasta' => [
        'Básica' => ['Fideos con tuco', 'Fideos con manteca', 'Tallarines con aceite'],
        'Intermedia' => ['Tallarines con crema', 'Ravioles con salsa', 'Lasaña de carne']
    ],
    'pescado' => [
        'Básica' => ['Pescado al horno', 'Filet de merluza', 'Pescado con papas'],
        'Intermedia' => ['Pescado relleno', 'Paella de mariscos', 'Filet de pescado con salsa']
    ]
];

if ($nombre === '' || $apellido === '') {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recetas</title>
</head>
<body>
    <h1>Hola <?php echo $nombre . ' ' . $apellido; ?></h1>

    <form action="recetas.php" method="post">
        <input type="hidden" name="nombre" value="<?php echo $nombre; ?>">
        <input type="hidden" name="apellido" value="<?php echo $apellido; ?>">

        <label for="categoria">Elegí una categoría:</label>
        <select name="categoria" id="categoria">
            <option value="carne">Carne</option>
            <option value="pasta">Pasta</option>
            <option value="pescado">Pescado</option>
        </select>

        <p>Dificultad:</p>
        <input type="radio" name="dificultad" id="basica" value="Básica" checked>
        <label for="basica">Básica</label>

        <input type="radio" name="dificultad" id="intermedia" value="Intermedia">
        <label for="intermedia">Intermedia</label>

        <input type="submit" value="Mostrar recetas">
    </form>

    <?php if (isset($recetas[$categoria][$dificultad])): ?>
        <h2>Recetas de <?php echo $categoria; ?></h2>
        <p>Dificultad elegida: <?php echo $dificultad; ?></p>
        <ul>
            <?php foreach ($recetas[$categoria][$dificultad] as $receta): ?>
                <li><?php echo $receta; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>

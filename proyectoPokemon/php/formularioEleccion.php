<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina - Equipo</title>
    <link rel="stylesheet" type="text/css" href="../css/formularioEleccionEquipo.css?v1=0" />
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
</head>

<body>
    <video autoplay muted loop id="videoFondo">
        <source src="../img/videoeleccionequipo_.mp4" type="video/mp4">
    </video>
</body>
</html>
<?php
include 'funcionesEleccion.php';
if (isset($_POST["mode_pve"]) || isset($_POST["peleapve"])) {
    rellenarSelectsPVE($pokemons);
} 
else if (isset($_POST["mode_pvp"]) || isset($_POST["peleapvp"])) {
    rellenarSelectsPVP($pokemons);
} else {
    header("Location: ../html/formularioIncorrecto.html"); //para que cuando meta la url sin hacer el form no haga nada
}


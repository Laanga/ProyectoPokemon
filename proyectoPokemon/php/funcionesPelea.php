<?php
include 'funcionesEleccion.php';

echo "<!DOCTYPE html>";
echo "<html lang='es'>";
echo "<head>";
echo "<meta charset='UTF-8'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<title>Combate Pokémon</title>";
echo "<link rel='stylesheet' href='../css/combate.css'>";
echo '<link rel="icon" type="image/x-icon" href="../img/favicon.ico">';
echo "</head>";
echo "<body>";

if(isset($_POST["volverInicio"])){
    header('Location: ../index.html');
    exit(); //para evitar que siga funcionando y te lleve a la pagina de tramposos
}
if (isset($_POST['peleapve'])) {
    
    $nombreJugador1 = $_POST['nombreJugador1'];
    //para ver si tiene un script en js
    if (str_contains($nombreJugador1, '<script>') || str_contains($nombreJugador1, '</script>')) {
        $nombreJugador1 = 'Jugador 1';
    }
    //si lo pone vacio
    if (empty($nombreJugador1)) {
        $nombreJugador1 = 'Jugador 1';
    }
}else if (isset($_POST['peleapvp'])) {
    $nombreJugador1pvp = $_POST['nombreJugador1pvp'];
    $nombreJugador2pvp = $_POST['nombreJugador2pvp'];

    if (str_contains($nombreJugador1pvp, '<script>') || str_contains($nombreJugador1pvp, '</script>') ||
        str_contains($nombreJugador2pvp, '<script>') || str_contains($nombreJugador2pvp, '</script>')) {
        $nombreJugador1pvp = 'Jugador1';
        $nombreJugador2pvp = 'Jugador2';
    }

    if (empty($nombreJugador1pvp) || empty($nombreJugador2pvp)) {
        $nombreJugador1pvp = 'Jugador 1';
        $nombreJugador2pvp = 'Jugador 2';
    }
} else {
    header("Location: ../html/formularioIncorrecto.html"); //para que cuando meta la url sin hacer el form no haga nada
}

if (isset($_POST['peleapve'])) {
    $pokemonsJugador1 = buscarPokemonsCompletos($_POST['pokemonJugador']['jugador1']);
    $pokemonsMaquina = buscarPokemonsCompletos($_POST['pokemonMaquina']);
    $nombreJugadorMaquina = 'Maquina';
    mostrarImagenes($pokemonsJugador1,$pokemonsMaquina,$nombreJugador1,$nombreJugadorMaquina);
    iniciarPelea($pokemonsJugador1, $pokemonsMaquina, $nombreJugador1, $nombreJugadorMaquina);

}

if (isset($_POST['peleapvp'])) {
    $pokemonsJugador1pvp = buscarPokemonsCompletos($_POST['pokemonJugador']['jugador1']);
    $pokemonsJugador2pvp = buscarPokemonsCompletos($_POST['pokemonJugador']['jugador2']);

    mostrarImagenes($pokemonsJugador1pvp,$pokemonsJugador2pvp,$nombreJugador1pvp,$nombreJugador2pvp);
    iniciarPelea($pokemonsJugador1pvp, $pokemonsJugador2pvp, $nombreJugador1pvp, $nombreJugador2pvp);

}

echo "</body>";
echo "</html>";

function buscarPokemonsCompletos($arrayPokemonsSoloNombre){
    $pokemons = $GLOBALS["pokemons"];
    $arrayPokemons = [];

    for ($i = 0; $i < count($arrayPokemonsSoloNombre); $i++) {
        for ($j = 0; $j < count($pokemons); $j++) {
            if ($arrayPokemonsSoloNombre[$i] == $pokemons[$j]['nombre']) {
                array_push($arrayPokemons, $pokemons[$j]);
            }
        }
    }

    return $arrayPokemons;
}

ob_start();

function iniciarPelea($pokemons1, $pokemons2, $nombreJugador1, $nombreJugador2){
    $ronda = 1;
    $pokemonJugador1 = array_shift($pokemons1);
    $pokemonJugador2 = array_shift($pokemons2);

    while (count($pokemons1) > 0 || count($pokemons2) > 0) {
        if ($pokemonJugador1['vida'] < 0) {
            $pokemonJugador1 = array_shift($pokemons1);
            $ronda++;
        } elseif ($pokemonJugador2['vida'] < 0) {
            $pokemonJugador2 = array_shift($pokemons2);
            $ronda++;
        }
        //meter las rondas y las imagenes 
        echo "<div class='battle-round'>";
        echo "<h2>Ronda $ronda: " . $pokemonJugador1['nombre'] . " vs " . $pokemonJugador2['nombre'] . "</h2>";

        echo "<div class='pokemon-images'>";
        echo "<div class='pokemon-image-jugador1'>
            <p class='fuente-pokemon'>" . $pokemonJugador1['nombre'] . "</p>
            <img src='" . $pokemonJugador1['imagen'] . "' alt='" . $pokemonJugador1['nombre'] . "'>
          </div>";
        echo "<div class='pokemon-image-jugador2'>
            <p class='fuente-pokemon'>" . $pokemonJugador2['nombre'] . "</p>
            <img src='" . $pokemonJugador2['imagen'] . "' alt='" . $pokemonJugador2['nombre'] . "'>

          </div>";
        echo "</div>";

        ob_flush(); //envia el contenido almacenado al buffer de salida
        flush(); //hace que el contenido se mande inmediatamente al navegador sin esperar
        sleep(1); //añade una pausa de 1 segundo entre cada paso

        $turno = 1;

        while ($pokemonJugador1['vida'] > 0 && $pokemonJugador2['vida'] > 0) {
            if ($pokemonJugador1['velocidad'] > $pokemonJugador2['velocidad']) {
                echo "<p class='fuente-pokemon'>Turno $turno</p>";
                echo "<p>" . turnoAtacar($pokemonJugador1, $pokemonJugador2) . "</p>";

                ob_flush(); 
                flush();
                sleep(1);

                if ($pokemonJugador2['vida'] <= 0) {
                    echo "</br>";
                    echo "<p class='fuente-roja'><strong>" . $pokemonJugador2['nombre'] . " se ha debilitado!</strong></p>";
                    break;
                }

                echo "<p>" . turnoAtacar($pokemonJugador2, $pokemonJugador1) . "</p>";

                ob_flush(); 
                flush();
                sleep(1);

                if ($pokemonJugador1['vida'] <= 0) {
                    echo "</br>";
                    echo "<p class='fuente-roja'><strong>" . $pokemonJugador1['nombre'] . " se ha debilitado!</strong></p>";
                    break;
                }
            } elseif ($pokemonJugador1['velocidad'] == $pokemonJugador2['velocidad']) {
                $numeroRandom = rand(0, 1);
                if ($numeroRandom == 0) {
                    echo "<p class='fuente-pokemon'>Turno $turno</p>";
                    echo "<p>" . turnoAtacar($pokemonJugador1, $pokemonJugador2) . "</p>";
                    ob_flush(); 
                    flush();
                    sleep(1);

                    if ($pokemonJugador2['vida'] <= 0) {
                        echo "</br>";
                        echo "<p class='fuente-roja'><strong>" . $pokemonJugador2['nombre'] . " se ha debilitado!</strong></p>";
                        break;
                    }

                    echo "<p>" . turnoAtacar($pokemonJugador2, $pokemonJugador1) . "</p>";
                    
                    ob_flush(); 
                    flush();
                    sleep(1);

                    if ($pokemonJugador1['vida'] <= 0) {
                        echo "</br>";
                        echo "<p class='fuente-roja'><strong>" . $pokemonJugador1['nombre'] . " se ha debilitado!</strong></p>";
                        break;
                    }
                } else {
                    echo "<p class='fuente-pokemon'>Turno $turno</p>";
                    echo "<p>" . turnoAtacar($pokemonJugador2, $pokemonJugador1) . "</p>";
                    ob_flush(); 
                    flush();
                    sleep(1);

                    if ($pokemonJugador1['vida'] <= 0) {
                        echo "</br>";
                        echo "<p class='fuente-roja'><strong>" . $pokemonJugador1['nombre'] . " se ha debilitado!</strong></p>";
                        break;
                    }

                    echo "<p>" . turnoAtacar($pokemonJugador1, $pokemonJugador2) . "</p>";
                    ob_flush(); 
                    flush();
                    sleep(1);

                    if ($pokemonJugador2['vida'] <= 0) {
                        echo "</br>";
                        echo "<p class='fuente-roja'><strong>" . $pokemonJugador2['nombre'] . " se ha debilitado!</strong></p>";
                        break;
                    }
                }
            } else {
                echo "<p class='fuente-pokemon'>Turno $turno</p>";
                echo "<p>" . turnoAtacar($pokemonJugador2, $pokemonJugador1) . "</p>";
                
                ob_flush(); 
                flush();
                sleep(1);

                if ($pokemonJugador1['vida'] <= 0) {
                    echo "</br>";
                    echo "<p class='fuente-roja'><strong>" . $pokemonJugador1['nombre'] . " se ha debilitado!</strong></p>";
                    break;
                }

                echo "<p>" . turnoAtacar($pokemonJugador1, $pokemonJugador2) . "</p>";
                
                ob_flush(); 
                flush();
                sleep(1);

                if ($pokemonJugador2['vida'] <= 0) {
                    echo "</br>";
                    echo "<p class='fuente-roja'><strong>" . $pokemonJugador2['nombre'] . " se ha debilitado!</strong></p>";
                    break;
                }
            }
            $turno++;
        }
        if ($pokemonJugador1['vida'] <= 0 && count($pokemons1) > 0) {
            $pokemonJugador1 = array_shift($pokemons1);
        } elseif ($pokemonJugador2['vida'] <= 0 && count($pokemons2) > 0) {
            $pokemonJugador2 = array_shift($pokemons2);
        } else {
            break;
        }
        $ronda++;
        echo "</div>";
    }
    echo '<div class="final">';
    
        if (count($pokemons1) <= 0) {
            echo "</br>";
            echo "<p class='ganadorFinal'><strong>El ganador final es: $nombreJugador2</strong></p>";
            echo "</br>";
        }   else {
            echo "</br>";
            echo "<p class = 'ganadorFinal'><strong>El ganador final es: $nombreJugador1</strong></p>";
            echo "</br>";
        }
        echo <<<FORM
        <form action="../index.html">
            <button type="submit">Volver a inicio</button>
        </form>        
        FORM;
    echo "</div>";

    ob_end_flush();
}

function turnoAtacar(&$atacante, &$defensor){
    $numRand = mt_rand(0, 100);
    $danio = ($numRand > 0 && $numRand <= 10) ? ($atacante['ataque'] * 1.50) - $defensor['defensa'] : $atacante['ataque'] - $defensor['defensa'];
    $danio = max(1, $danio);
    $defensor['vida'] -= $danio;

    if ($numRand > 0 && $numRand <= 10) {
        return "¡Ataque crítico! " . $atacante['nombre'] . " infligió " . $danio . " de daño a " . $defensor['nombre'];
    } else {
        return $atacante['nombre'] . " infligió " . $danio . " de daño a " . $defensor['nombre'];
    }
}


function mostrarImagenes($arrayPokemons1,$arrayPokemons2,$nombre1,$nombre2){
    $pokemons = $GLOBALS["pokemons"];
    //mostrar jugador 1
    echo '<div class="contenedor-grande">';
    echo '<div class="primer-equipo">';
    echo "<h3>" . "Equipo de " . $nombre1 . "</h3>";
    if (isset($_POST['peleapve']) || isset($_POST['peleapvp'])) {
        foreach ($arrayPokemons1 as $pokemonJugador) {
            foreach ($pokemons as $pokemon) {
                if ($pokemon['nombre'] === $pokemonJugador['nombre']) {
                    echo '<img src="' . $pokemon['imagen'] . '" alt="' . $pokemon['nombre'] . '">';
                }
            }
        }
    }
    echo "</div>";
    //mostrar jugador 2
    echo '<div class="segundo-equipo">';
    echo "<h3>" . "Equipo de " . $nombre2 . "</h3>";
    if (isset($_POST['peleapve']) || isset($_POST['peleapvp'])) {
        foreach ($arrayPokemons2 as $pokemonJugador) {
            foreach ($pokemons as $pokemon) {
                if ($pokemon['nombre'] === $pokemonJugador['nombre']) {
                    echo '<img src="' . $pokemon['imagen'] . '" alt="' . $pokemon['nombre'] . '">';                    
                }
            }
        }
    }
    echo "</div>";
    echo "</div>";
}

<?php
function rellenarSelectsPVE($pokemons){
    echo "<form method='post' action='funcionesPelea.php'>";
    echo '<div class="container-grande">';
    echo '<div class="container-izquierda">';
    echo '<label for="nombreJugador1" > Introduce tu nombre <span class="rojo">*</span></label>';
    echo "</br>";
    echo '<input type="text" id="nombreJugador1" name="nombreJugador1"/>';
    echo "</br>";

    //pokemons del jugador real
    for ($i = 0; $i < 6; $i++) {
        echo "<label>" . ($i + 1) . "º Pokemon </label>";
        echo '<select name="pokemonJugador[jugador1][]">';
        $arrayNumerosRand = [];
        while(count($arrayNumerosRand) < count($pokemons)) {
            $numRand = rand(0, count($pokemons) - 1);
    
            if (!in_array($numRand, $arrayNumerosRand)) {
                $arrayNumerosRand[] = $numRand;
                $pokemon = $pokemons[$numRand];
                echo '<option value="' . $pokemon['nombre'] . '">' . $pokemon['nombre'] . '</option>';
            }
        }
    
        echo '</select>';
        echo "<br>";
    }

        echo '</div>';
        echo '<div class = "boton-contenedor">';
        echo '<button type= "submit" name="peleapve">A PELEAR!!!</button>';
        echo '<button type= "submit" name="volverInicio">Volver inicio</button>';
        echo '</div>';
        echo '<div class="container-derecha">';
        echo "<p>Pokemons de la Maquina </p>";
        //pokemons de la maquina
        $pokemonsMaquina = sacarPokemonsMaquina($pokemons);
        $contPokemon = 1;
        foreach ($pokemonsMaquina as $pokemonMaquina) {
            echo "<label>" . $contPokemon . "º Pokemon " . "</label>";
            echo '<select name="pokemonMaquina[]">';
            echo "<option value='" . ($pokemonMaquina) . "' selected>";
            echo $pokemonMaquina;
            echo '</option>';
            echo "</select>";
            echo "</br>";
            $contPokemon++;
            $i++;
        }
        echo '</div>';
        echo '</div>';
        echo "</form>";
    }
    

function rellenarSelectsPVP($pokemons)
{
    //pokemons del jugador 1 (izquierda)
    echo "<form method='post' action='funcionesPelea.php'>";
    echo '<div class="container-grande">';
    echo '<div class="container-izquierda">';
    echo '<label for="nombreJugador1pvp"> Introduce tu nombre <span class="rojo">*</span></label>';
    echo '<input type="text" id="nombreJugador1pvp" name="nombreJugador1pvp"/> </br>';
    for ($i = 0; $i < 6; $i++) {
        echo "<label>" . ($i + 1) . "º Pokemon </label>";
        echo '<select name="pokemonJugador[jugador1][]">';
        $arrayNumerosRand = [];
        while(count($arrayNumerosRand) < count($pokemons)) {
            $numRand = rand(0, count($pokemons) - 1);
    
            if (!in_array($numRand, $arrayNumerosRand)) {
                $arrayNumerosRand[] = $numRand;
                $pokemon = $pokemons[$numRand];
                echo '<option value="' . $pokemon['nombre'] . '">' . $pokemon['nombre'] . '</option>';
            }
        }
    
        echo '</select>';
        echo "<br>";
    }
    echo '</div>';

    echo '<div class = "boton-contenedor">';
    echo '<button type= "submit" name="peleapvp">A PELEAR!!!</button>';
    echo '<button type= "submit" name="volverInicio">Volver inicio</button>';
    echo '</div>';
    //pokemons del jugador 2 (derecha)
    echo '<div class="container-derecha">';
    echo '<label for="nombreJugador2pvp"> Introduce tu nombre <span class="rojo">*</span></label>';
    echo '<input type="text" id="nombreJugador2pvp" name="nombreJugador2pvp"/></br>';
    for ($i = 0; $i < 6; $i++) {
        echo "<label>" . ($i + 1) . "º Pokemon </label>";
        echo '<select name="pokemonJugador[jugador2][]">';
        $arrayNumerosRand = [];
        while(count($arrayNumerosRand) < count($pokemons)) {
            $numRand = rand(0, count($pokemons) - 1);
    
            if (!in_array($numRand, $arrayNumerosRand)) {
                $arrayNumerosRand[] = $numRand;
                $pokemon = $pokemons[$numRand];
                echo '<option value="' . $pokemon['nombre'] . '">' . $pokemon['nombre'] . '</option>';
            }
        }
    
        echo '</select>';
        echo "<br>";
    }
    echo '</div>';
    echo '</div>';
    echo "</form>";
}


function sacarPokemonsMaquina($pokemons){
    $arrayPokemonsMaquina = [];

    while (count($arrayPokemonsMaquina) < 6) {
        $randomIndex = mt_rand(0, count($pokemons) - 1);

        $nombrePokemon = $pokemons[$randomIndex]['nombre'];

        if (!in_array($nombrePokemon, $arrayPokemonsMaquina)) {
            $arrayPokemonsMaquina[] = $nombrePokemon;
        }
    }
    return $arrayPokemonsMaquina;
}

$pokemons = [
    [
        'nombre' => 'Venusaur',
        'pokedex_numero' => 3,
        'vida' => 155,
        'ataque' => 82,
        'defensa' => 83,
        'velocidad' => 80,
        'imagen' => 'https://img.pokemondb.net/sprites/black-white/anim/normal/venusaur.gif'
    ],
    [
        'nombre' => 'Charizard',
        'pokedex_numero' => 6,
        'vida' => 156,
        'ataque' => 84,
        'defensa' => 78,
        'velocidad' => 100,
        'imagen' => 'https://img.pokemondb.net/sprites/black-white/anim/normal/charizard.gif'
    ],
    [
        'nombre' => 'Blastoise',
        'pokedex_numero' => 9,
        'vida' => 158,
        'ataque' => 83,
        'defensa' => 76,
        'velocidad' => 78,
        'imagen' => 'https://img.pokemondb.net/sprites/black-white/anim/normal/blastoise.gif'
    ],
    [
        'nombre' => 'Dragonite',
        'pokedex_numero' => 149,
        'vida' => 177,
        'ataque' => 134,
        'defensa' => 78,
        'velocidad' => 80,
        'imagen' => 'https://img.pokemondb.net/sprites/black-white/anim/normal/dragonite.gif'
    ],
    [
        'nombre' => 'Mewtwo',
        'pokedex_numero' => 150,
        'vida' => 197,
        'ataque' => 110,
        'defensa' => 77,
        'velocidad' => 130,
        'imagen' => 'https://img.pokemondb.net/sprites/black-white/anim/normal/mewtwo.gif'
    ],
    [
        'nombre' => 'Gyarados',
        'pokedex_numero' => 130,
        'vida' => 170,
        'ataque' => 125,
        'defensa' => 79,
        'velocidad' => 81,
        'imagen' => 'https://img.pokemondb.net/sprites/black-white/anim/normal/gyarados.gif'
    ],
    [
        'nombre' => 'Snorlax',
        'pokedex_numero' => 143,
        'vida' => 267,
        'ataque' => 110,
        'defensa' => 65,
        'velocidad' => 30,
        'imagen' => 'https://img.pokemondb.net/sprites/black-white/anim/normal/snorlax.gif'
    ],
    [
        'nombre' => 'Vaporeon',
        'pokedex_numero' => 134,
        'vida' => 230,
        'ataque' => 65,
        'defensa' => 60,
        'velocidad' => 65,
        'imagen' => 'https://img.pokemondb.net/sprites/black-white/anim/normal/vaporeon.gif'
    ],
    [
        'nombre' => 'Machamp',
        'pokedex_numero' => 68,
        'vida' => 190,
        'ataque' => 130,
        'defensa' => 80,
        'velocidad' => 55,
        'imagen' => 'https://img.pokemondb.net/sprites/black-white/anim/normal/machamp.gif'
    ],
    [
        'nombre' => 'Gengar',
        'pokedex_numero' => 94,
        'vida' => 135,
        'ataque' => 65,
        'defensa' => 60,
        'velocidad' => 110,
        'imagen' => 'https://img.pokemondb.net/sprites/black-white/anim/normal/gengar.gif'
    ],
    [
        'nombre' => 'Alakazam',
        'pokedex_numero' => 65,
        'vida' => 125,
        'ataque' => 50,
        'defensa' => 45,
        'velocidad' => 120,
        'imagen' => 'https://img.pokemondb.net/sprites/black-white/anim/normal/alakazam.gif'
    ],
    [
        'nombre' => 'Golem',
        'pokedex_numero' => 76,
        'vida' => 150,
        'ataque' => 120,
        'defensa' => 60,
        'velocidad' => 45,
        'imagen' => 'https://img.pokemondb.net/sprites/black-white/anim/normal/golem.gif'
    ],
    [
        'nombre' => 'Arcanine',
        'pokedex_numero' => 59,
        'vida' => 165,
        'ataque' => 110,
        'defensa' => 80,
        'velocidad' => 95,
        'imagen' => 'https://img.pokemondb.net/sprites/black-white/anim/normal/arcanine.gif'
    ],
    [
        'nombre' => 'Muk',
        'pokedex_numero' => 89,
        'vida' => 180,
        'ataque' => 105,
        'defensa' => 75,
        'velocidad' => 50,
        'imagen' => 'https://img.pokemondb.net/sprites/black-white/anim/normal/muk.gif'
    ],
    [
        'nombre' => 'Exeggutor',
        'pokedex_numero' => 103,
        'vida' => 170,
        'ataque' => 95,
        'defensa' => 85,
        'velocidad' => 55,
        'imagen' => 'https://img.pokemondb.net/sprites/black-white/anim/normal/exeggutor.gif'
    ],
    [
        'nombre' => 'Cloyster',
        'pokedex_numero' => 91,
        'vida' => 125,
        'ataque' => 95,
        'defensa' => 76,
        'velocidad' => 70,
        'imagen' => 'https://img.pokemondb.net/sprites/black-white/anim/normal/cloyster.gif'
    ],
    [
        'nombre' => 'Starmie',
        'pokedex_numero' => 121,
        'vida' => 135,
        'ataque' => 75,
        'defensa' => 85,
        'velocidad' => 115,
        'imagen' => 'https://img.pokemondb.net/sprites/black-white/anim/normal/starmie.gif'
    ],
    [
        'nombre' => 'Magmar',
        'pokedex_numero' => 126,
        'vida' => 155,
        'ataque' => 95,
        'defensa' => 57,
        'velocidad' => 93,
        'imagen' => 'https://img.pokemondb.net/sprites/black-white/anim/normal/magmar.gif'
    ],
    [
        'nombre' => 'Electabuzz',
        'pokedex_numero' => 125,
        'vida' => 155,
        'ataque' => 83,
        'defensa' => 57,
        'velocidad' => 105,
        'imagen' => 'https://img.pokemondb.net/sprites/black-white/anim/normal/electabuzz.gif'
    ],
    [
        'nombre' => 'Pidgeot',
        'pokedex_numero' => 18,
        'vida' => 160,
        'ataque' => 80,
        'defensa' => 75,
        'velocidad' => 101,
        'imagen' => 'https://img.pokemondb.net/sprites/black-white/anim/normal/pidgeot.gif'
    ],
    [
            'nombre' => 'Torterra',
            'pokedex_numero' => 389,
            'vida' => 160,
            'ataque' => 109,
            'defensa' => 73,
            'velocidad' => 56,
            'imagen' => 'https://img.pokemondb.net/sprites/black-white/anim/normal/torterra.gif'
        ],
        [
            'nombre' => 'Infernape',
            'pokedex_numero' => 392,
            'vida' => 104,
            'ataque' => 104,
            'defensa' => 71,
            'velocidad' => 108,
            'imagen' => 'https://img.pokemondb.net/sprites/black-white/anim/normal/infernape.gif'
        ],
        [
            'nombre' => 'Empoleon',
            'pokedex_numero' => 395,
            'vida' => 115,
            'ataque' => 86,
            'defensa' => 74,
            'velocidad' => 60,
            'imagen' => 'https://img.pokemondb.net/sprites/black-white/anim/normal/empoleon.gif'
        ],
        [
            'nombre' => 'Garchomp',
            'pokedex_numero' => 445,
            'vida' => 108,
            'ataque' => 130,
            'defensa' => 67,
            'velocidad' => 102,
            'imagen' => 'https://img.pokemondb.net/sprites/black-white/anim/normal/garchomp.gif'
        ],
        [
            'nombre' => 'Giratina',
            'pokedex_numero' => 487,
            'vida' => 150,
            'ataque' => 120,
            'defensa' => 65,
            'velocidad' => 90,
            'imagen' => 'https://img.pokemondb.net/sprites/black-white/anim/normal/giratina-origin.gif'
        ],
        [
            'nombre' => 'Darkrai',
            'pokedex_numero' => 491,
            'vida' => 70,
            'ataque' => 90,
            'defensa' => 69,
            'velocidad' => 125,
            'imagen' => 'https://img.pokemondb.net/sprites/black-white/anim/normal/darkrai.gif'
        ],
        [
            'nombre' => 'Mamoswine',
            'pokedex_numero' => 473,
            'vida' => 110,
            'ataque' => 130,
            'defensa' => 80,
            'velocidad' => 80,
            'imagen' => 'https://img.pokemondb.net/sprites/black-white/anim/normal/mamoswine.gif'
        ],
        [
            'nombre' => 'Gliscor',
            'pokedex_numero' => 472,
            'vida' => 75,
            'ataque' => 95,
            'defensa' => 73,
            'velocidad' => 95,
            'imagen' => 'https://img.pokemondb.net/sprites/black-white/anim/normal/gliscor.gif'
        ],
        [
            'nombre' => 'Lucario',
            'pokedex_numero' => 448,
            'vida' => 70,
            'ataque' => 110,
            'defensa' => 70,
            'velocidad' => 90,
            'imagen' => 'https://img.pokemondb.net/sprites/black-white/anim/normal/lucario.gif'
        ],
        [
            'nombre' => 'Flygon',
            'pokedex_numero' => 330,
            'vida' => 80,
            'ataque' => 100,
            'defensa' => 80,
            'velocidad' => 100,
            'imagen' => 'https://img.pokemondb.net/sprites/black-white/anim/normal/flygon.gif'
        ],
        [
            'nombre' => 'Sceptile',
            'pokedex_numero' => 254,
            'vida' => 70,
            'ataque' => 85,
            'defensa' => 65,
            'velocidad' => 120,
            'imagen' => 'https://img.pokemondb.net/sprites/black-white/anim/normal/sceptile.gif'
        ],
        [
            'nombre' => 'Blaziken',
            'pokedex_numero' => 257,
            'vida' => 80,
            'ataque' => 120,
            'defensa' => 70,
            'velocidad' => 80,
            'imagen' => 'https://img.pokemondb.net/sprites/black-white/anim/normal/blaziken.gif'
        ],
        [
            'nombre' => 'Swampert',
            'pokedex_numero' => 260,
            'vida' => 100,
            'ataque' => 110,
            'defensa' => 90,
            'velocidad' => 60,
            'imagen' => 'https://img.pokemondb.net/sprites/black-white/anim/normal/swampert.gif'
        ],
        [
            'nombre' => 'Metagross',
            'pokedex_numero' => 376,
            'vida' => 80,
            'ataque' => 135,
            'defensa' => 79,
            'velocidad' => 70,
            'imagen' => 'https://img.pokemondb.net/sprites/black-white/anim/normal/metagross.gif'
        ],
        [
            'nombre' => 'Haxorus',
            'pokedex_numero' => 612,
            'vida' => 76,
            'ataque' => 147,
            'defensa' => 90,
            'velocidad' => 97,
            'imagen' => 'https://img.pokemondb.net/sprites/black-white/anim/normal/haxorus.gif'
        ],
        [
            'nombre' => 'Excadrill',
            'pokedex_numero' => 530,
            'vida' => 110,
            'ataque' => 135,
            'defensa' => 60,
            'velocidad' => 88,
            'imagen' => 'https://img.pokemondb.net/sprites/black-white/anim/normal/excadrill.gif'
        ],
        [
            'nombre' => 'Serperior',
            'pokedex_numero' => 497,
            'vida' => 75,
            'ataque' => 75,
            'defensa' => 95,
            'velocidad' => 113,
            'imagen' => 'https://img.pokemondb.net/sprites/black-white/anim/normal/serperior.gif'
        ],
        [
            'nombre' => 'Emboar',
            'pokedex_numero' => 500,
            'vida' => 110,
            'ataque' => 123,
            'defensa' => 65,
            'velocidad' => 65,
            'imagen' => 'https://img.pokemondb.net/sprites/black-white-2/anim/normal/emboar.gif'
        ],
        [
            'nombre' => 'Samurott',
            'pokedex_numero' => 503,
            'vida' => 95,
            'ataque' => 100,
            'defensa' => 85,
            'velocidad' => 70,
            'imagen' => 'https://img.pokemondb.net/sprites/black-white-2/anim/normal/samurott.gif'
        ],
        [
            'nombre' => 'Tyranitar',
            'pokedex_numero' => 248,
            'vida' => 100,
            'ataque' => 134,
            'defensa' => 90,
            'velocidad' => 61,
            'imagen' => 'https://img.pokemondb.net/sprites/black-white/anim/normal/tyranitar.gif'
        ],
        [
            'nombre' => 'Rayquaza',
            'pokedex_numero' => 384,
            'vida' => 105,
            'ataque' => 150,
            'defensa' => 80,
            'velocidad' => 95,
            'imagen' => 'https://img.pokemondb.net/sprites/black-white/anim/normal/rayquaza.gif'
        ]
    ];
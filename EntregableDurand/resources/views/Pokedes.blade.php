<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pokédex</title>
    <link rel="stylesheet" href="{{ asset('css/EstilosPokedes.css') }}">
</head>
<body>

<div class="pokedex-frame">

    <div class="led"></div>

    <div class="screen">
        <h1>Pokédex GBA</h1>

        <div class="pokedex-container">

            @foreach ($Todoslospokemones as $poke)
                <div class="pokemon-card">
                    <div class="pokemon-id">#{{ $poke['id'] }}</div>

                    <img src="{{ $poke['image_default'] }}" class="pokemon-img">

                    <div class="pokemon-name">{{ $poke['name'] }}</div>

                    @if ($poke['image_shiny'])
                        <div class="shiny-label">Versión Shiny</div>
                        <img src="{{ $poke['image_shiny'] }}" class="pokemon-img-shiny">
                    @endif
                </div>
            @endforeach

        </div>

    </div>

</div>

</body>
</html>

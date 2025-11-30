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
        <h1>Pokédex GLOBAL</h1>

        <div class="pokedex-container"> 

            @foreach ($pokemonsPaginados as $poke)
                <div class="pokemon-card">
                    <div class="pokemon-id">Nº{{ $poke['id'] }}</div>

                    <img src="{{ $poke['image_default'] }}" class="pokemon-img">

                    <div class="pokemon-name">{{ $poke['name'] }}</div>

                    @if ($poke['image_shiny'])
                        <div class="shiny-label">Versión Shiny</div>
                        <img src="{{ $poke['image_shiny'] }}" class="pokemon-img-shiny">
                    @endif
                </div>
            @endforeach

        </div>

        <div class="pagination-arrows">
           @if ($pokemonsPaginados->onFirstPage())
             <span class="arrow disabled">‹</span>
           @else
              <a href="{{ $pokemonsPaginados->previousPageUrl() }}" class="arrow">‹</a>
           @endif

           @if ($pokemonsPaginados->hasMorePages())
               <a href="{{ $pokemonsPaginados->nextPageUrl() }}" class="arrow">›</a>
           @else
              <span class="arrow disabled">›</span>
           @endif
         </div>

        
    </div>

</div>

</body>
</html>
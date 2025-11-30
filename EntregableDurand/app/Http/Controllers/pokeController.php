<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class pokeController extends Controller
{
    public function LaPokedes(Request $request) 
    {
        $clienteAsh = new Client();
        $response = $clienteAsh->get('https://pokeapi.co/api/v2/pokemon/?limit=1000');
        $data = json_decode($response->getBody()->getContents(), true);

        $promises = [];
        foreach ($data['results'] as $pokemon) {
            $promises[] = $clienteAsh->getAsync($pokemon['url']);
        }
        $responses = Promise\Utils::unwrap($promises);

        $Todoslospokemones = [];
        foreach ($responses as $res) {
            $pd = json_decode($res->getBody()->getContents(), true);

            $Todoslospokemones[] = [
                'id'            => $pd['id'],
                'name'          => ucfirst($pd['name']),
                'image_default' => $pd['sprites']['other']['official-artwork']['front_default'] ?? null,
                'image_shiny'   => $pd['sprites']['other']['official-artwork']['front_shiny'] ?? null,
            ];
        }
        $collection = new Collection($Todoslospokemones);

        $perPage = 25;
        
        $currentPage = $request->get('page', 1);

        $offset = ($currentPage * $perPage) - $perPage;
        $itemsForCurrentPage = $collection->slice($offset, $perPage)->all();

        
        $pokemonsPaginados = new LengthAwarePaginator(
            $itemsForCurrentPage, 
            $collection->count(), 
            $perPage,            
            $currentPage,        
            ['path' => $request->url()] 
        );
        
        return view('pokedes', compact('pokemonsPaginados'));
    }
}
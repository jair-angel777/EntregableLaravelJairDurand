<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use App\Http\Controllers\Controller;

class PokeController extends Controller
{
    public function LaPokedes()
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
                'id'    => $pd['id'],
                'name'  => ucfirst($pd['name']),
                'image_default' => $pd['sprites']['other']['official-artwork']['front_default'] ?? null,
                'image_shiny'   => $pd['sprites']['other']['official-artwork']['front_shiny'] ?? null,
            ];
        }

        return view('pokedes', compact('Todoslospokemones'));
    }
}

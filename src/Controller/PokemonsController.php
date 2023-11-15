<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PokemonsController extends AbstractController {

    #[Route("/pokemon")]

    public function getPokemon(){
        $pokemon = [
            "name" => "Bulbasaur",
            "description" => "Bulbasaur is the first Pokémon species discovered in the wild. It",
            "image" => "https://assets.pokemon.com/assets/cms2/img/pokedex/full/001.png",
            "code" => "001"
        ];
            return $this -> render("Pokemons/showPokemon.html.twig", ["pokemon" => $pokemon]);
    }

    #[Route("/pokemons")]
    
    public function listPokemons(){
        $pokemons = [
            [
                "name" => "Bulbasaur",
                "description" => "Bulbasaur is the first Pokémon species discovered in the wild. It",
                "image" => "https://assets.pokemon.com/assets/cms2/img/pokedex/full/001.png",
                "code" => "001"
            ],
            [
                "name" => "charmander",
                "description" => "charmander is the first Pokémon species discovered in the wild. It",
                "image" => "https://assets.pokemon.com/assets/cms2/img/pokedex/full/002.png",
                "code" => "002"
            ],
            [
                "name" => "squirtle",
                "description" => "squirtle is the first Pokémon species discovered in the wild. It",
                "image" => "https://assets.pokemon.com/assets/cms2/img/pokedex/full/003.png",
                "code" => "001"
            ],
            [
                "name" => "pikachu",
                "description" => "pikachu is the first Pokémon species discovered in the wild. It",
                "image" => "https://assets.pokemon.com/assets/cms2/img/pokedex/full/025.png",
                "code" => "001"
            ]
        ];
        return $this -> render("Pokemons/listPokemons.html.twig", ["pokemons" => $pokemons]);
    }
}
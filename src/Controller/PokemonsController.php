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

    #[Route("/pokemons/showPokemons")]

    public function listPokemons(){
        $pokemons = [
            [
            "name" => "Bulbasaur",
            "description" => "Bulbasaur is the first Pokémon species discovered in the wild. It",
            "image" => "https://assets.pokemon.com/assets/cms2/img/pokedex/full/001.png",
            "code" => "001"]
        ,
            [
                "name" => "Ivysaur",
                "description" => "Ivysaur is the second Pokémon species discovered in the wild. It",
                "image" => "https://assets.pokemon.com/assets/cms2/img/pokedex/full/002.png",
                "code" => "002"
            ],
            [
                "name" => "Venusaur",
                "description" => "Venusaur is the third Pokémon species discovered in the wild. It",
                "image" => "https://assets.pokemon.com/assets/cms2/img/pokedex/full/003.png",
                "code" => "003"],
                [
                    "name" => "Charmander",
                    "description" => "Charmander is the fourth Pokémon species discovered in the wild. It",
                    "image" => "https://assets.pokemon.com/assets/cms2/img/pokedex/full/004.png",
                    "code" => "004"
                ],
                [
                    "name" => "Charmeleon",
                    "description" => "Charmeleon is the fifth Pokémon species discovered in the wild. It",
                    "image" => "https://assets.pokemon.com/assets/cms2/img/pokedex/full/005.png",
                    "code" => "005"
                ]
        ];
        return $this -> render("Pokemons/listPokemons.html.twig", ["pokemons" => $pokemons]);
    }
}
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
}
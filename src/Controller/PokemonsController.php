<?php

namespace App\Controller;

use App\Entity\Pokemon;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PokemonsController extends AbstractController {

    #[Route("/pokemon/{id}", name:"pokemonInfo")]

    public function getPokemon(EntityManagerInterface $doctrine, $id){

        $repositorio = $doctrine -> getRepository(Pokemon::class);

        $pokemon = $repositorio -> find($id);

            return $this -> render("Pokemons/showPokemon.html.twig", ["pokemon" => $pokemon]);
    }

        #[Route("/insert/pokemon")]

    public function insertPokemon(EntityManagerInterface $doctrine){
        $pokemon = new Pokemon();
        $pokemon2 = new Pokemon();
        $pokemon3 = new Pokemon();


        $pokemon -> setName("Bulbasaur");
        $pokemon -> setDescription("Bulbasaur is the first Pokémon species discovered in the wild. It");
        $pokemon -> setImage("https://assets.pokemon.com/assets/cms2/img/pokedex/full/001.png");
        $pokemon -> setCode(1);

        $pokemon2 -> setName("charmander");
        $pokemon2 -> setDescription("Bulbasaur is the first Pokémon species discovered in the wild. It");
        $pokemon2 -> setImage("https://assets.pokemon.com/assets/cms2/img/pokedex/full/004.png");
        $pokemon2 -> setCode(1);

        $pokemon3 -> setName("squirtle");
        $pokemon3 -> setDescription("Bulbasaur is the first Pokémon species discovered in the wild. It");
        $pokemon3 -> setImage("https://assets.pokemon.com/assets/cms2/img/pokedex/full/254.png");
        $pokemon3 -> setCode(1);

        $doctrine -> persist($pokemon);
        $doctrine -> persist($pokemon2);
        $doctrine -> persist($pokemon3);

        $doctrine -> flush();

        return new Response("Pokemon insertado correctamente");
    }

    #[Route("/pokemons", name:"listPokemon")]
    
    public function listPokemons(EntityManagerInterface $doctrine){

        $repositorio = $doctrine -> getRepository(Pokemon::class);

        $pokemons = $repositorio -> findAll();

        return $this -> render("Pokemons/listPokemons.html.twig", ["pokemons" => $pokemons]);
    }


}
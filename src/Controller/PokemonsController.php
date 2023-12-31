<?php

namespace App\Controller;

use App\Entity\Debilidad;
use App\Entity\Pokemon;
use App\Form\PokemonType;
use App\Manager\PokemonManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class PokemonsController extends AbstractController
{

    #[Route("/pokemon/{id}", name: "pokemonInfo")]

    public function getPokemon(EntityManagerInterface $doctrine, $id)
    {

        $repositorio = $doctrine->getRepository(Pokemon::class);

        $pokemon = $repositorio->find($id);

        return $this->render("Pokemons/showPokemon.html.twig", ["pokemon" => $pokemon]);
    }

    #[Route("/insert/pokemon")]

    public function insertPokemon(EntityManagerInterface $doctrine)
    {
        $pokemon = new Pokemon();
        $pokemon2 = new Pokemon();
        $pokemon3 = new Pokemon();


        $pokemon->setName("Bulbasaur");
        $pokemon->setDescription("Bulbasaur is the first Pokémon species discovered in the wild. It");
        $pokemon->setImage("https://assets.pokemon.com/assets/cms2/img/pokedex/full/001.png");
        $pokemon->setCode(1);

        $pokemon2->setName("charmander");
        $pokemon2->setDescription("Bulbasaur is the first Pokémon species discovered in the wild. It");
        $pokemon2->setImage("https://assets.pokemon.com/assets/cms2/img/pokedex/full/004.png");
        $pokemon2->setCode(1);

        $pokemon3->setName("squirtle");
        $pokemon3->setDescription("Bulbasaur is the first Pokémon species discovered in the wild. It");
        $pokemon3->setImage("https://assets.pokemon.com/assets/cms2/img/pokedex/full/254.png");
        $pokemon3->setCode(1);

        $debilidad = new Debilidad();
        $debilidad->setName("Fuego");

        $debilidad2 = new Debilidad();
        $debilidad2->setName("Hielo");

        $debilidad3 = new Debilidad();
        $debilidad3->setName("Tierra");

        $pokemon->addDebilidade($debilidad);
        $pokemon2->addDebilidade($debilidad);
        $pokemon2->addDebilidade($debilidad2);
        $pokemon3->addDebilidade($debilidad);
        $pokemon3->addDebilidade($debilidad2);
        $pokemon3->addDebilidade($debilidad3);

        $doctrine->persist($debilidad);
        $doctrine->persist($debilidad2);
        $doctrine->persist($debilidad3);

        $doctrine->persist($pokemon);
        $doctrine->persist($pokemon2);
        $doctrine->persist($pokemon3);

        $doctrine->flush();

        return new Response("Pokemon insertado correctamente");
    }

    #[Route("/pokemons", name: "listPokemon")]

    public function listPokemons(EntityManagerInterface $doctrine)
    {

        $repositorio = $doctrine->getRepository(Pokemon::class);

        $pokemons = $repositorio->findAll();

        return $this->render("Pokemons/listPokemons.html.twig", ["pokemons" => $pokemons]);
    }


    #[Route("/delete/pokemon/{id}", name: "deletepokemon")]

    public function deletePokemon($id, EntityManagerInterface $doctrine)
    {
        $repositorio = $doctrine->getRepository(Pokemon::class);

        $pokemon = $repositorio->find($id);

        $doctrine->remove($pokemon);
        $doctrine->flush();

        return $this->redirectToRoute("listPokemon");
    }

    #[Route("/create/pokemon", name: "createPokemon")]
    public function createPokemon(EntityManagerInterface $doctrine, Request $request, PokemonManager $manager){
        $form = $this->createForm(PokemonType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $pokemon = $form->getData();
            $imageFile = $form->get('imageFile')->getData();
            $findName = $manager->loadFile($imageFile, $this->getParameter('kernel.project_dir').'/public/images');
            $pokemon-> setImage("images/$findName");
            $doctrine->persist($pokemon);
            $doctrine->flush();
            $this -> addFlash('success', 'Pokemon insertado correctamente');
            $this -> addFlash('error', 'Pokemon no insertado');
            return $this->redirectToRoute("listPokemon");
        }
        return $this->render("Pokemons/createPokemon.html.twig", ["Pokemonform" => $form]);
    }
    #[Route("/edit/pokemon/{id}", name: "editPokemon")]
    public function editPokemon($id, EntityManagerInterface $doctrine, Request $request){
        $repositorio = $doctrine->getRepository(Pokemon::class);
        $pokemon = $repositorio->find($id);
        $form = $this->createForm(PokemonType::class, $pokemon);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $pokemon = $form->getData();
            $doctrine->persist($pokemon);
            $doctrine->flush();
            $this -> addFlash('success', 'Pokemon insertado correctamente');
            $this -> addFlash('error', 'Pokemon no insertado');
            return $this->redirectToRoute("listPokemon");
        }
        return $this->render("Pokemons/createPokemon.html.twig", ["Pokemonform" => $form]);
    }

    #[Route("/react/pokemon")]
    public function reactPokemon()
    {
        return $this->render("Pokemons/reactPokemon.html.twig");
    }
}


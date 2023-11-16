<?php

namespace App\Controller;

use App\Entity\Pokemon;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route("/api/pokemons", name: "listApiPokemon")]

    public function listPokemons(EntityManagerInterface $doctrine)
    {

        $repositorio = $doctrine->getRepository(Pokemon::class);

        $pokemons = $repositorio->findAll();

        return $this->json($pokemons);
    }

}

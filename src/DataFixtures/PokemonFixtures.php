<?php

namespace App\DataFixtures;

use App\Entity\Pokemon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PokemonFixtures extends Fixture
{
    protected $httpClient;

    public function __construct(HttpClientInterface $client)
    {
        $this->httpClient = $client;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();

        for ($i=0; $i<100; $i++){
            $codPokemon = $faker->numberBetween(100, 999);

            $response = $this->httpClient->request('GET', "https://pokeapi.co/api/v2/pokemon/$codPokemon");

            $pokemonData = $response->toArray();

            $pokemon = new Pokemon();
            $pokemon->setName($pokemonData['name']);
            $pokemon->setDescription($faker->text);
            $pokemon->setCode($codPokemon);
            $pokemon->setImage("https://assets.pokemon.com/assets/cms2/img/pokedex/full/$codPokemon.png");

            $manager->persist($pokemon);
        }

        $manager->flush();
    }
}

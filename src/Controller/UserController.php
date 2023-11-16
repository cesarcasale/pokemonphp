<?php

namespace App\Controller;

use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/create/user', name: 'registerUser')]
    public function registerUser(EntityManagerInterface $doctrine, Request $request, UserPasswordHasherInterface $hasher): Response
    {
        $form = $this->createForm(UserType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $password = $user -> getPassword();
            $newpassword = $hasher->hashPassword($user, $password);
            $user->setPassword($newpassword);
            $doctrine->persist($user);
            $doctrine->flush();
            $this -> addFlash('success', 'usuario insertado correctamente');
            $this -> addFlash('error', 'usuario no insertado');
            return $this->redirectToRoute("listPokemon");
        }
        return $this->render("Pokemons/createPokemon.html.twig", ["Pokemonform" => $form]);
    }

    #[Route('/create/admin', name: 'registerAdmin')]
    public function registerAdmin(EntityManagerInterface $doctrine, Request $request, UserPasswordHasherInterface $hasher): Response
    {
        $form = $this->createForm(UserType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $password = $user -> getPassword();
            $newpassword = $hasher->hashPassword($user, $password);
            $user->setPassword($newpassword);
            $user->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
            $doctrine->persist($user);
            $doctrine->flush();
            $this -> addFlash('success', 'usuario insertado correctamente');
            $this -> addFlash('error', 'usuario no insertado');
            return $this->redirectToRoute("listPokemon");
        }
        return $this->render("Pokemons/createPokemon.html.twig", ["Pokemonform" => $form]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Pokemon;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

#[Route('/api', name: 'api_')]
class PokemonController extends AbstractController
{
    #[Route('/pokemons', name: 'pokemon_index', methods:['get'] )]
    public function index(ManagerRegistry $doctrine): JsonResponse
    {
        $pokemons = $doctrine
            ->getRepository(Pokemon::class)
            ->findAll();

        $data = [];

        foreach ($pokemons as $pokemon) {
            $data[] = $pokemon;
        }

        return $this->json($data);
    }


    #[Route('/pokemons', name: 'pokemon_create', methods:['post'] )]
    public function create(ManagerRegistry $doctrine, Request $request): JsonResponse
    {
        $entityManager = $doctrine->getManager();

        $pokemon = new Pokemon();
        $pokemon->setName($request->request->get('name'));
        $pokemon->setDescription($request->request->get('description'));

        $entityManager->persist($pokemon);
        $entityManager->flush();

        $data =  [
            'id' => $pokemon->getId(),
            'name' => $pokemon->getName(),
            'description' => $pokemon->getDescription(),
        ];

        return $this->json($data);
    }


    #[Route('/pokemons/{id}', name: 'pokemon_show', methods:['get'] )]
    public function show(ManagerRegistry $doctrine, int $id): JsonResponse
    {
        $pokemon = $doctrine->getRepository(Pokemon::class)->find($id);

        if (!$pokemon) {

            return $this->json('Нет покемона для id ' . $id, 404);
        }

        $data =  [
            'id' => $pokemon->getId(),
            'name' => $pokemon->getName(),
            'description' => $pokemon->getDescription(),
        ];

        return $this->json($data);
    }

    #[Route('/pokemons/{id}', name: 'pokemon_update', methods:['put', 'patch'] )]
    public function update(ManagerRegistry $doctrine, Request $request, int $id): JsonResponse
    {
        $entityManager = $doctrine->getManager();
        $pokemon = $entityManager->getRepository(Pokemon::class)->find($id);

        if (!$pokemon) {
            return $this->json('Нет покемона для id' . $id, 404);
        }

        $pokemon->setName($request->request->get('name'));
        $pokemon->setDescription($request->request->get('description'));
        $entityManager->flush();

        $data =  [
            'id' => $pokemon->getId(),
            'name' => $pokemon->getName(),
            'description' => $pokemon->getDescription(),
        ];

        return $this->json($data);
    }

    #[Route('/pokemons/{id}', name: 'pokemon_delete', methods:['delete'] )]
    public function delete(ManagerRegistry $doctrine, int $id): JsonResponse
    {
        $entityManager = $doctrine->getManager();
        $pokemon = $entityManager->getRepository(Pokemon::class)->find($id);

        if (!$pokemon) {
            return $this->json('Нет покемона для id' . $id, 404);
        }

        $entityManager->remove($pokemon);
        $entityManager->flush();

        return $this->json('Удален покемон с id ' . $id);
    }
}
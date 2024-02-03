<?php

namespace App\Controller;

use App\ArgumentResolver\QueryParam;
use App\Entity\Pokemon;
use App\Exception\AbilityNotFoundException;
use App\Repository\AbilityRepository;
use App\Repository\PokemonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

#[Route('/api', name: 'api_')]
class PokemonController extends AbstractController
{
    public function __construct(private readonly PokemonRepository      $pokemonRepository,
                                private readonly AbilityRepository      $abilityRepository,
                                private readonly EntityManagerInterface $objectManager
    )
    {
    }

    #[Route(path: "", name: "all", methods: ["GET"])]
    public function all(Request $request): Response
    {
        $keyword = $request->request->get('keyword');
        $offset = $request->request->get('offset');
        $limit = $request->request->get('limit');

        $data = $this->pokemonRepository->findByKeyword($keyword ?: '', $offset, $limit);

        return $this->json($data);
    }


    #[Route('/pokemons', name: 'pokemon_index', methods:['get'] )]
    public function index(): JsonResponse
    {
        $pokemons = $this->objectManager
            ->getRepository(Pokemon::class)
            ->findAll();

        $data = [];

        foreach ($pokemons as $pokemon) {
            $data[] = [
                'id' => $pokemon->getId(),
                'name' => $pokemon->getName(),
                'image' => $pokemon->getImage(),
                'shape' => $pokemon->getShape(),
                'abilities' => $pokemon->getAbilities(),
            ];;
        }

        return $this->json($data);
    }


    #[Route('/pokemons', name: 'pokemon_create', methods:['post'] )]
    public function create(Request $request): JsonResponse
    {
        $pokemon = new Pokemon();
        $pokemon->setName($request->request->get('name'));
        $pokemon->setSort($request->request->get('sort'));
        $pokemon->setShape($request->request->get('shape'));
        $abilityIds = explode(',', $request->request->get('ability_ids'));

        if (!empty($abilityIds)) {
            foreach ($abilityIds as $id) {
                $ability = $this->abilityRepository->findOneBy(["id" => (int)$id]);

                if (!$ability) {
                    throw new AbilityNotFoundException((int)$id);
                }

                $pokemon->addAbility($ability);
            }
        }

        $this->objectManager->persist($pokemon);
        $this->objectManager->flush();

        $data =  [
            'id' => $pokemon->getId(),
            'name' => $pokemon->getName(),
            'image' => $pokemon->getImage(),
            'shape' => $pokemon->getShape(),
            'abilities' => $pokemon->getAbilities(),
        ];

        return $this->json($data);
    }


    #[Route('/pokemons/{id}', name: 'pokemon_show', methods:['get'] )]
    public function show(int $id): JsonResponse
    {
        $pokemon = $this->objectManager->getRepository(Pokemon::class)->find($id);

        if (!$pokemon) {
            return $this->json('Нет покемона для id ' . $id, 404);
        }

        $data =  [
            'id' => $pokemon->getId(),
            'name' => $pokemon->getName(),
            'image' => $pokemon->getImage(),
            'shape' => $pokemon->getShape(),
            'abilities' => $pokemon->getAbilities(),
        ];

        return $this->json($data);
    }

    #[Route('/pokemons/{id}', name: 'pokemon_update', methods:['post'] )]
    public function update(Request $request, int $id): JsonResponse
    {
        $pokemon = $this->objectManager->getRepository(Pokemon::class)->find($id);

        if (!$pokemon) {
            return $this->json('Нет покемона для id' . $id, 404);
        }

        $pokemon->setName($request->request->get('name'));
        $pokemon->setSort($request->request->get('sort'));
        $pokemon->setShape($request->request->get('shape'));

        $abilityIds = explode(',', $request->request->get('ability_ids'));
        $pokemon->deleteAbilities();

        if (!empty($abilityIds)) {
            foreach ($abilityIds as $id) {
                $ability = $this->abilityRepository->findOneBy(["id" => (int)$id]);

                if (!$ability) {
                    throw new AbilityNotFoundException((int)$id);
                }

                $pokemon->addAbility($ability);
            }
        }
        $this->objectManager->flush();

        $data =  [
            'id' => $pokemon->getId(),
            'name' => $pokemon->getName(),
            'image' => $pokemon->getImage(),
            'shape' => $pokemon->getShape(),
            'abilities' => $pokemon->getAbilities(),
        ];

        return $this->json($data);
    }

    #[Route('/pokemons/{id}', name: 'pokemon_delete', methods:['delete'] )]
    public function delete(ManagerRegistry $doctrine, int $id): JsonResponse
    {
        $pokemon = $this->objectManager->getRepository(Pokemon::class)->find($id);

        if (!$pokemon) {
            return $this->json('Нет покемона для id' . $id, 404);
        }

        $this->objectManager->remove($pokemon);
        $this->objectManager->flush();

        return $this->json('Удален покемон с id ' . $id);
    }
}
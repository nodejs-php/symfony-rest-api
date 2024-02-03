<?php

namespace App\DataFixtures;

use App\Factory\AbilityFactory;
use App\Factory\PokemonFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $ability = AbilityFactory::createOne(['name' => 'ability1', 'lang' => 'en', 'image' => 'image1']);
        $ability->save();

        $pokemon = PokemonFactory::new()->createOne(
            [
                'name' => 'name1',
                'sort' => 1,
                'image' => 'image1',
                'shape' => 'head',
                'location' => 'City',
            ]
        );
        $pokemon->setAbility($ability->object());
        $pokemon->save();
    }
}

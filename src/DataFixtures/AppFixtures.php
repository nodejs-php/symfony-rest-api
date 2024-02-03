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
        $fly = AbilityFactory::createOne(['name' => 'fly', 'lang' => 'en', 'image' => 'fly-image1']);
        $fly->save();

        $swim = AbilityFactory::createOne(['name' => 'swim', 'lang' => 'en', 'image' => 'swim-image1']);
        $swim->save();

        $run = AbilityFactory::createOne(['name' => 'run', 'lang' => 'en', 'image' => 'run-image1']);
        $run->save();

        $bird = PokemonFactory::new()->createOne(
            [
                'name' => 'bird',
                'sort' => 1,
                'image' => 'bird1',
                'shape' => 'head',
                'location' => 'Forest',
            ]
        );
        $bird->addAbility($fly->object());
        $bird->addAbility($run->object());
        $bird->save();

        $fish = PokemonFactory::new()->createOne(
            [
                'name' => 'fish',
                'sort' => 1,
                'image' => 'fish1',
                'shape' => 'fins',
                'location' => 'Water',
            ]
        );
        $fish->addAbility($swim->object());
        $fish->save();
    }
}

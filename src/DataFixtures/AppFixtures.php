<?php

namespace App\DataFixtures;

use App\Factory\AbilityFactory;
use App\Factory\LocationFactory;
use App\Factory\PokemonFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $location1 = LocationFactory::new()->createOne([ 'name' => 'Hoenn'] )->save();

        $location2 = LocationFactory::new()->createOne([ 'name' => 'Volcano'] );
        $location2->addParent($location1->object());
        $location2->save();

        $location3 = LocationFactory::new()->createOne([ 'name' => 'Cinnabar Gym'] );
        $location3->addParent($location2->object());
        $location3->save();

        $location4 = LocationFactory::new()->createOne([ 'name' => 'Mansion'] );
        $location4->addParent($location1->object());
        $location4->save();

        $location5 = LocationFactory::new()->createOne([ 'name' => 'Cinnabar Lab - Kanto'] );
        $location5->addParent($location2->object());
        $location5->save();


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
            ]
        );
        $bird->addAbility($fly->object());
        $bird->addAbility($run->object());
        $bird->addLocation($location3->object());
        $bird->save();

        $fish = PokemonFactory::new()->createOne(
            [
                'name' => 'fish',
                'sort' => 1,
                'image' => 'fish1',
                'shape' => 'fins',
            ]
        );
        $fish->addAbility($swim->object());
        $fish->addLocation($location4->object());
        $fish->save();
    }
}

<?php

namespace App\Command;

use App\Entity\Ability;
use App\Entity\Location;
use App\Factory\PokemonFactory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:create-pokemon')]
class CreatePokemonCommand extends Command
{
    public function __construct(private readonly EntityManagerInterface $objectManager
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Создает покемона')
            ->setHelp('Эта команда позволяет тебе создать покемона...');
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        dump('Создается покемон');

        $fish = PokemonFactory::new()->createOne(
            [
                'name' => 'fish',
                'sort' => 1,
                'image' => 'fish1',
                'shape' => 'fins',
            ]
        );
        $ability = $this->objectManager->getRepository(Ability::class)->find(5);
        $location = $this->objectManager->getRepository(Location::class)->find(10);
        $fish->addAbility($ability);
        $fish->addLocation($location);
        $fish->save();

        return Command::SUCCESS;
    }
}
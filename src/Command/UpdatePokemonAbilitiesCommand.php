<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:update-pokemon')]
class UpdatePokemonAbilitiesCommand extends Command
{
    public function __construct(private readonly EntityManagerInterface $objectManager
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Обновляет возможности покемонов')
            ->setHelp('Эта команда позволяет обновлять возможности покемонов...');
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        dump('Обновляет возможности покемонов');

        $client = new Client([
            "timeout" => 30,
        ]);

        $response = $client->get("https://pokeapi.co/api/v2/ability");
        dump($response->getBody()->getContents());

        return Command::SUCCESS;
    }
}
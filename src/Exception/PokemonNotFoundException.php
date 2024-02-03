<?php

namespace App\Exception;

use Symfony\Component\Uid\Uuid;

class PokemonNotFoundException extends \RuntimeException
{

    public function __construct(int $id)
    {
        parent::__construct("Покемон #" . $id . " не найден");
    }

}
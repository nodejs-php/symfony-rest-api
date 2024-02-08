<?php

namespace App\Exception;

class PokemonNotFoundException extends \RuntimeException
{

    public function __construct(int $id)
    {
        parent::__construct("Покемон #" . $id . " не найден");
    }

}
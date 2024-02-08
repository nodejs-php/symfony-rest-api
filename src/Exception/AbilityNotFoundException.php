<?php

namespace App\Exception;

class AbilityNotFoundException extends \RuntimeException
{

    public function __construct(int $id)
    {
        parent::__construct("Способность #" . $id . " не найдена");
    }

}
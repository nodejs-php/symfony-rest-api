<?php

namespace App\Exception;

use Symfony\Component\Uid\Uuid;

class AbilityNotFoundException extends \RuntimeException
{

    public function __construct(int $id)
    {
        parent::__construct("Способность #" . $id . " не найдена");
    }

}
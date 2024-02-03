<?php

namespace App\Requests;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class PokemonRequest extends BaseRequest
{
    #[Type('integer')]
    #[NotBlank()]
    protected $id;

    #[NotBlank([])]
    protected $name;

    #[NotBlank([])]
    protected $sort;

    #[NotBlank([])]
    protected $shape;

    #[NotBlank([])]
    protected $location;

    protected function autoValidateRequest(): bool
    {
        return false;
    }
}
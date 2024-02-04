<?php

namespace App\Requests;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class FilterPokemonRequest extends BaseRequest
{
    #[Type('integer')]
    #[NotBlank()]
    protected $keyword;

    #[NotBlank([])]
    protected $offset;

    #[NotBlank([])]
    protected $limit;

    #[NotBlank([])]
    protected $shape;

    #[NotBlank([])]
    protected $location;

    protected function autoValidateRequest(): bool
    {
        return false;
    }
}
<?php

namespace App\Dto;

class PokemonSummaryDto
{
    private string $id;
    private string $title;

    static function of(string $id, string $title): PokemonSummaryDto
    {
        $dto = new PokemonSummaryDto();
        $dto->setId($id)->setTitle($title);
        return $dto;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return PokemonSummaryDto
     */
    public function setId(string $id): PokemonSummaryDto
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    public function __toString(): string
    {
        return "PokemonSummaryDto[title=." . $this->title . ", id." . $this->id . "]";
    }

}
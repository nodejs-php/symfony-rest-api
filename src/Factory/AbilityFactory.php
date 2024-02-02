<?php

namespace App\Factory;

use App\Entity\Ability;
use App\Repository\AbilityRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Ability>
 *
 * @method        Ability|Proxy                     create(array|callable $attributes = [])
 * @method static Ability|Proxy                     createOne(array $attributes = [])
 * @method static Ability|Proxy                     find(object|array|mixed $criteria)
 * @method static Ability|Proxy                     findOrCreate(array $attributes)
 * @method static Ability|Proxy                     first(string $sortedField = 'id')
 * @method static Ability|Proxy                     last(string $sortedField = 'id')
 * @method static Ability|Proxy                     random(array $attributes = [])
 * @method static Ability|Proxy                     randomOrCreate(array $attributes = [])
 * @method static AbilityRepository|RepositoryProxy repository()
 * @method static Ability[]|Proxy[]                 all()
 * @method static Ability[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Ability[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Ability[]|Proxy[]                 findBy(array $attributes)
 * @method static Ability[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Ability[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class AbilityFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'lang' => self::faker()->text(10),
            'name' => self::faker()->text(50),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Ability $ability): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Ability::class;
    }
}

<?php

namespace App\Factory;

use App\Entity\Album;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;
use function Zenstruck\Foundry\lazy;

/**
 * @extends ModelFactory<Album>
 *
 * @method        Album|Proxy                      create(array|callable $attributes = [])
 * @method static Album|Proxy                      createOne(array $attributes = [])
 * @method static Album|Proxy                      find(object|array|mixed $criteria)
 * @method static Album|Proxy                      findOrCreate(array $attributes)
 * @method static Album|Proxy                      first(string $sortedField = 'id')
 * @method static Album|Proxy                      last(string $sortedField = 'id')
 * @method static Album|Proxy                      random(array $attributes = [])
 * @method static Album|Proxy                      randomOrCreate(array $attributes = [])
 * @method static EntityRepository|RepositoryProxy repository()
 * @method static Album[]|Proxy[]                  all()
 * @method static Album[]|Proxy[]                  createMany(int $number, array|callable $attributes = [])
 * @method static Album[]|Proxy[]                  createSequence(iterable|callable $sequence)
 * @method static Album[]|Proxy[]                  findBy(array $attributes)
 * @method static Album[]|Proxy[]                  randomRange(int $min, int $max, array $attributes = [])
 * @method static Album[]|Proxy[]                  randomSet(int $number, array $attributes = [])
 */
final class AlbumFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct(private UserRepository $userRepository)
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
            'title' => self::faker()->text(20),
            'description' => self::faker()->text(),
            'ownerId' => $this->userRepository->findOneBy([
                'id' => self::faker()->numberBetween(1, 3),
            ]),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Album $album): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Album::class;
    }
}

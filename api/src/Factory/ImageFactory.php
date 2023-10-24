<?php

namespace App\Factory;

use App\Entity\Image;
use Doctrine\ORM\EntityRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;
use function Zenstruck\Foundry\lazy;

/**
 * @extends ModelFactory<Image>
 *
 * @method        Image|Proxy                      create(array|callable $attributes = [])
 * @method static Image|Proxy                      createOne(array $attributes = [])
 * @method static Image|Proxy                      find(object|array|mixed $criteria)
 * @method static Image|Proxy                      findOrCreate(array $attributes)
 * @method static Image|Proxy                      first(string $sortedField = 'id')
 * @method static Image|Proxy                      last(string $sortedField = 'id')
 * @method static Image|Proxy                      random(array $attributes = [])
 * @method static Image|Proxy                      randomOrCreate(array $attributes = [])
 * @method static EntityRepository|RepositoryProxy repository()
 * @method static Image[]|Proxy[]                  all()
 * @method static Image[]|Proxy[]                  createMany(int $number, array|callable $attributes = [])
 * @method static Image[]|Proxy[]                  createSequence(iterable|callable $sequence)
 * @method static Image[]|Proxy[]                  findBy(array $attributes)
 * @method static Image[]|Proxy[]                  randomRange(int $min, int $max, array $attributes = [])
 * @method static Image[]|Proxy[]                  randomSet(int $number, array $attributes = [])
 */
final class ImageFactory extends ModelFactory
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
            'album' => lazy(fn() => AlbumFactory::random()),
            'url' => self::faker()->url(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Image $image): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Image::class;
    }
}

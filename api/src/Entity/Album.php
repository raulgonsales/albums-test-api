<?php

declare(strict_types = 1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ApiResource]
class Album
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\Column(nullable: false)]
    public string $title = '';

    #[ORM\Column(type: 'text', nullable: true)]
    public ?string $description = '';

    /** @var Image[] */
    #[ORM\OneToMany(mappedBy: 'album', targetEntity: Image::class, cascade: ['persist', 'remove'])]
    public iterable $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}

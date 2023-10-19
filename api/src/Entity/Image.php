<?php

declare(strict_types = 1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ApiResource]
class Image
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank]
    public string $url = '';

    #[ORM\ManyToOne(inversedBy: 'images')]
    public ?Album $album = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}

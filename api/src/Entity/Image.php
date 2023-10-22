<?php

declare(strict_types = 1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ApiResource(formats: ['json'], routePrefix: '/api', normalizationContext: ['groups' => ['get']])]
class Image
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank]
    #[Groups('get')]
    private string $url = '';

    #[ORM\ManyToOne(inversedBy: 'images')]
    private ?Album $album = null;

    public function __construct(string $url, ?Album $album)
    {
        $this->url = $url;
        $this->album = $album;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function getAlbum(): ?Album
    {
        return $this->album;
    }
}

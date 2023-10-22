<?php

declare(strict_types = 1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Controller\CreateAlbum;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ApiResource(operations: [
    new GetCollection(),
    new Get(),
    new Post(
        uriTemplate: '/albums',
        controller: CreateAlbum::class,
        name: 'create_album',
    )
], formats: ['json'], routePrefix: '/api', normalizationContext: ['groups' => ['get']], denormalizationContext: ['groups' => ['post']])]
class Album
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\Column(nullable: false)]
    #[Assert\NotBlank]
    #[Groups('get')]
    private string $title = '';

    #[ORM\Column(type: 'text', nullable: true)]
    #[Groups('get')]
    private ?string $description = '';

    #[ORM\OneToMany(mappedBy: 'album', targetEntity: Image::class, cascade: ['persist', 'remove'])]
    #[Groups('get')]
    private Collection $images;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'albums')]
    #[Groups('get')]
    private ?User $ownerId = null;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getImages(): iterable
    {
        return $this->images;
    }

    public function setImages(Collection $images): void
    {
        $this->images = $images;
    }

    public function getOwnerId(): ?User
    {
        return $this->ownerId;
    }

    public function setOwnerId(?User $ownerId): void
    {
        $this->ownerId = $ownerId;
    }

    public static function createFromArray(array $data): self
    {
        $newAlbum = new self();
        $newAlbum->setTitle($data['title'] ?? '');
        $newAlbum->setDescription($data['description'] ?? '');

        if (!isset($data['images']) || !is_array($data['images'])) {
            return $newAlbum;
        }

        $images = new ArrayCollection();
        foreach ($data['images'] as $image) {
            if (!$image['url']) {
                continue;
            }

            $newImage = new Image($image['url'], $newAlbum);

            $images->add($newImage);
        }

        $newAlbum->setImages($images);

        return $newAlbum;
    }
}

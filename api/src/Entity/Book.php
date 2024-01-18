<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\BookRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ApiResource(
    // ON peut choisir quels champs seront sérialisés sur des GET
    // normalizationContext: ['groups' => ['book']],

    // ON peut aussi choisir quels champs seront désérialisés quand on POST/PUT/PATCH
    // denormalizationContext: ['groups' => ['book', 'book:write']],
    
    // ON peut lister les opérations autorisées
    // operations: [
        // new Get(
        //     uriTemplate: "/livres/{id}"
        // ),
        // new GetCollection(
        //     uriTemplate: "/livres"
        // )
    // ]
)]
#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups("book")]
    #[ORM\Column(length: 255)]
    private ?string $title = null;

    
    #[Groups("book:write")]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;
    
    #[ORM\Column(type: Types::TEXT)]
    #[Groups("book:write")]
    private ?string $content = null;

    #[ORM\ManyToOne(inversedBy: 'books')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Author $author = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): static
    {
        $this->author = $author;

        return $this;
    }
}

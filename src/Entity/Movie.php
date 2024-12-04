<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[UniqueEntity(fields: ['title'])]
#[ORM\Entity(repositoryClass: MovieRepository::class)]
class Movie
{
    #[Groups(['person:extra'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank(
        message: 'Le titre est obligatoire',
    )]
    #[Assert\Length(
        max: 80,
        maxMessage: 'Le titre ne peut pas dépasser {{ limit }} caractères'
    )]
    #[Groups(['person:extra'])]
    #[ORM\Column(length: 80)]
    private ?string $title = null;

    #[Assert\Length(
        max: 2000,
        maxMessage: 'Le résumé ne peut pas dépasser {{ limit }} caractères'
    )]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $summary = null;

    #[Assert\Url(
        protocols: ['https'],
        requireTld: true,
    )]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $poster = null;

    #[Assert\LessThan('today')]
    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?DateTimeInterface $releasedAt = null;

    #[Assert\NotNull]
    #[ORM\Column]
    private ?bool $allPublic = null;

    #[Assert\NotNull]
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[Assert\NotNull]
    #[ORM\ManyToOne(fetch: 'EAGER', inversedBy: 'directedMovies')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Person $director = null;

    /**
     * @var Collection<int, Person>
     */
    #[Assert\Count(min: 2)]
    #[ORM\ManyToMany(targetEntity: Person::class, inversedBy: 'actedMovies')]
    #[ORM\JoinTable(name: 'cast')]
    private Collection $actors;

    public function __construct()
    {
        $this->actors = new ArrayCollection();
    }

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

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(?string $summary): static
    {
        $this->summary = $summary;

        return $this;
    }

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function setPoster(?string $poster): static
    {
        $this->poster = $poster;

        return $this;
    }

    public function getReleasedAt(): ?DateTimeInterface
    {
        return $this->releasedAt;
    }

    public function setReleasedAt(?DateTimeInterface $releasedAt): static
    {
        $this->releasedAt = $releasedAt;

        return $this;
    }

    public function isAllPublic(): ?bool
    {
        return $this->allPublic;
    }

    public function setAllPublic(bool $allPublic): static
    {
        $this->allPublic = $allPublic;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getDirector(): ?Person
    {
        return $this->director;
    }

    public function setDirector(?Person $director): static
    {
        $this->director = $director;

        return $this;
    }

    /**
     * @return Collection<int, Person>
     */
    public function getActors(): Collection
    {
        return $this->actors;
    }

    public function addActor(Person $actor): static
    {
        if (!$this->actors->contains($actor)) {
            $this->actors->add($actor);
        }

        return $this;
    }

    public function removeActor(Person $actor): static
    {
        $this->actors->removeElement($actor);

        return $this;
    }

    public function relativeRelease(): string
    {
        $now = new DateTime();

        return $now->diff($this->releasedAt)->y;
    }
}

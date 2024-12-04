<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Repository\PersonRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(
            normalizationContext: ['groups' => ['person:read', 'person:extra']],
        ),
        new Post(),
        new Patch(),
        new Delete(
            security: 'is_granted("ROLE_ADMIN")',
        ),
    ],
    normalizationContext: [
        'groups' => ['person:read'],
    ],
)]
#[ORM\Entity(repositoryClass: PersonRepository::class)]
class Person
{
    #[Groups(['person:read'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['person:read'])]
    #[Assert\NotBlank]
    #[ORM\Column(length: 60)]
    private ?string $firstname = null;

    #[Groups(['person:read'])]
    #[Assert\NotBlank]
    #[ORM\Column(length: 60)]
    private ?string $lastname = null;

    #[Groups(['person:read'])]
    #[Assert\NotBlank]
    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?DateTimeImmutable $birthdate = null;

    /**
     * @var Collection<int, Movie>
     */
    #[Groups(['person:extra'])]
    #[ORM\OneToMany(targetEntity: Movie::class, mappedBy: 'director')]
    private Collection $directedMovies;

    /**
     * @var Collection<int, Movie>
     */
    #[Groups(['person:extra'])]
    #[ORM\ManyToMany(targetEntity: Movie::class, mappedBy: 'actors')]
    private Collection $actedMovies;

    public function __construct()
    {
        $this->directedMovies = new ArrayCollection();
        $this->actedMovies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getBirthdate(): ?DateTimeImmutable
    {
        return $this->birthdate;
    }

    public function setBirthdate(DateTimeImmutable $birthdate): static
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * @return Collection<int, Movie>
     */
    public function getDirectedMovies(): Collection
    {
        return $this->directedMovies;
    }

    public function addDirectedMovie(Movie $directedMovie): static
    {
        if (!$this->directedMovies->contains($directedMovie)) {
            $this->directedMovies->add($directedMovie);
            $directedMovie->setDirector($this);
        }

        return $this;
    }

    public function removeDirectedMovie(Movie $directedMovie): static
    {
        if ($this->directedMovies->removeElement($directedMovie)) {
            if ($directedMovie->getDirector() === $this) {
                $directedMovie->setDirector(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Movie>
     */
    public function getActedMovies(): Collection
    {
        return $this->actedMovies;
    }

    public function addActedMovie(Movie $actedMovie): static
    {
        if (!$this->actedMovies->contains($actedMovie)) {
            $this->actedMovies->add($actedMovie);
            $actedMovie->addActor($this);
        }

        return $this;
    }

    public function removeActedMovie(Movie $actedMovie): static
    {
        if ($this->actedMovies->removeElement($actedMovie)) {
            $actedMovie->removeActor($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}

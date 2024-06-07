<?php

namespace App\Entity;

use App\Repository\ScienceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;

use Carbon\Carbon;

use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Metadata\ApiFilter;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;

use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ScienceRepository::class)]
#[ApiResource(
    description: 'A rare and valuable treasure.',
    shortName: 'Science',
    operations: [
        new Get(),
        new GetCollection(),
        new Post(),
        new Put(),
        new Patch(),
    ]
)]
#[ApiFilter(BooleanFilter::class, properties: ['published'])]

class Science
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ApiFilter(SearchFilter::class, strategy: 'partial')]
    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $image = null;

    #[Assert\NotBlank]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $body = null;

    #[ORM\Column(nullable: true)]
    private ?bool $published = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $createdat = null;

    #[ORM\ManyToMany(targetEntity: Tag1::class, inversedBy: 'sciences')]
    private Collection $Tag1;

    public function __construct()
    {
        $this->Tag1 = new ArrayCollection();
        $this->setcreatedat(new \DateTime());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function getImageUrl(): ?string
    {
        if (!$this->image) {
            return null;
        }
        if (strpos($this->image, '/') !== false) {
            return $this->image;
        }
        return sprintf('/uploads/science/%s', $this->image);
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(?string $body): static
    {
        $this->body = $body;

        return $this;
    }

    public function isPublished(): ?bool
    {
        return $this->published;
    }

    public function setPublished(?bool $published): static
    {
        $this->published = $published;

        return $this;
    }

    public function getCreatedat(): ?\DateTimeInterface
    {
        return $this->createdat;
    }

    public function setCreatedat(?\DateTimeInterface $createdat): static
    {
        $this->createdat = $createdat;

        return $this;
    }

    /**
     * @return Collection<int, Tag1>
     */
    public function getTag1(): Collection
    {
        return $this->Tag1;
    }

    public function addTag1(Tag1 $tag1): static
    {
        if (!$this->Tag1->contains($tag1)) {
            $this->Tag1->add($tag1);
        }

        return $this;
    }

    public function removeTag1(Tag1 $tag1): static
    {
        $this->Tag1->removeElement($tag1);

        return $this;
    }

}

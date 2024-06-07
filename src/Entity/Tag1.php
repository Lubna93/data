<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;

use App\Repository\Tag1Repository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: Tag1Repository::class)]
#[ApiResource]
class Tag1
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titret = null;

    #[ORM\ManyToMany(targetEntity: Science::class, mappedBy: 'Tag1')]
    private Collection $sciences;

    public function __construct()
    {
        $this->sciences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitret(): ?string
    {
        return $this->titret;
    }

    public function setTitret(string $titret): static
    {
        $this->titret = $titret;

        return $this;
    }

    /**
     * @return Collection<int, Science>
     */
    public function getSciences(): Collection
    {
        return $this->sciences;
    }

    public function addScience(Science $science): static
    {
        if (!$this->sciences->contains($science)) {
            $this->sciences->add($science);
            $science->addTag1($this);
        }

        return $this;
    }

    public function removeScience(Science $science): static
    {
        if ($this->sciences->removeElement($science)) {
            $science->removeTag1($this);
        }

        return $this;
    }

    public function __toString(): string
    {
      return $this->titret;   
    }

}

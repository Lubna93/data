<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeRepository::class)]
#[ApiResource]
class Type
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titret = null;

    /**
     * @var Collection<int, Data>
     */
    #[ORM\OneToMany(targetEntity: Data::class, mappedBy: 'type')]
    private Collection $datas;

    public function __construct()
    {
        $this->datas = new ArrayCollection();
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
     * @return Collection<int, Data>
     */
    public function getDatas(): Collection
    {
        return $this->datas;
    }

    public function addData(Data $data): static
    {
        if (!$this->datas->contains($data)) {
            $this->datas->add($data);
            $data->setType($this);
        }

        return $this;
    }

    public function removeData(Data $data): static
    {
        if ($this->datas->removeElement($data)) {
            // set the owning side to null (unless already changed)
            if ($data->getType() === $this) {
                $data->setType(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
      return $this->titret;   
    }
}

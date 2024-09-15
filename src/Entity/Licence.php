<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\LicenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LicenceRepository::class)]
#[ApiResource]
class Licence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titrel = null;

    /**
     * @var Collection<int, Data>
     */
    #[ORM\OneToMany(targetEntity: Data::class, mappedBy: 'Licence')]
    private Collection $datas;

    public function __construct()
    {
        $this->datas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitrel(): ?string
    {
        return $this->titrel;
    }

    public function setTitrel(string $titrel): static
    {
        $this->titrel = $titrel;

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
            $data->setLicence($this);
        }

        return $this;
    }

    public function removeData(Data $data): static
    {
        if ($this->datas->removeElement($data)) {
            // set the owning side to null (unless already changed)
            if ($data->getLicence() === $this) {
                $data->setLicence(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
      return $this->titrel;   
    }
}

<?php

namespace App\Entity;

use App\Repository\ClienteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClienteRepository::class)
 */
class Cliente
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomnre;

    /**
     * @ORM\OneToMany(targetEntity=City::class, mappedBy="cliente")
     */
    private $city;

    public function __construct()
    {
        $this->city = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomnre(): ?string
    {
        return $this->nomnre;
    }

    public function setNomnre(string $nomnre): self
    {
        $this->nomnre = $nomnre;

        return $this;
    }

    /**
     * @return Collection<int, City>
     */
    public function getCity(): Collection
    {
        return $this->city;
    }

    public function addCity(City $city): self
    {
        if (!$this->city->contains($city)) {
            $this->city[] = $city;
            $city->setCliente($this);
        }

        return $this;
    }

    public function removeCity(City $city): self
    {
        if ($this->city->removeElement($city)) {
            // set the owning side to null (unless already changed)
            if ($city->getCliente() === $this) {
                $city->setCliente(null);
            }
        }

        return $this;
    }
}

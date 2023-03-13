<?php

namespace App\Entity;

use App\Repository\MarcaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MarcaRepository::class)]
class Marca
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $descripcion = null;

    #[ORM\OneToMany(mappedBy: 'marca', targetEntity: Producto::class)]
    private Collection $marca;

    public function __construct()
    {
        $this->marca = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * @return Collection<int, Producto>
     */
    public function getMarca(): Collection
    {
        return $this->marca;
    }

    public function addMarca(Producto $marca): self
    {
        if (!$this->marca->contains($marca)) {
            $this->marca->add($marca);
            $marca->setMarca($this);
        }

        return $this;
    }

    public function removeMarca(Producto $marca): self
    {
        if ($this->marca->removeElement($marca)) {
            // set the owning side to null (unless already changed)
            if ($marca->getMarca() === $this) {
                $marca->setMarca(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->descripcion;
    }
}

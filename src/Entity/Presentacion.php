<?php

namespace App\Entity;

use App\Repository\PresentacionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PresentacionRepository::class)]
class Presentacion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $descripcion = null;

    #[ORM\OneToMany(mappedBy: 'presentacion', targetEntity: Producto::class)]
    private Collection $presentacion;

    public function __construct()
    {
        $this->presentacion = new ArrayCollection();
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
    public function getPresentacion(): Collection
    {
        return $this->presentacion;
    }

    public function addPresentacion(Producto $presentacion): self
    {
        if (!$this->presentacion->contains($presentacion)) {
            $this->presentacion->add($presentacion);
            $presentacion->setPresentacion($this);
        }

        return $this;
    }

    public function removePresentacion(Producto $presentacion): self
    {
        if ($this->presentacion->removeElement($presentacion)) {
            // set the owning side to null (unless already changed)
            if ($presentacion->getPresentacion() === $this) {
                $presentacion->setPresentacion(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->descripcion;
    }
}

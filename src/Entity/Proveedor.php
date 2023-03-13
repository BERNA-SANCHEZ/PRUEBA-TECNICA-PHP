<?php

namespace App\Entity;

use App\Repository\ProveedorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProveedorRepository::class)]
class Proveedor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $descripcion = null;

    #[ORM\OneToMany(mappedBy: 'proveedor', targetEntity: Producto::class)]
    private Collection $proveedor;

    public function __construct($descripcion = null)
    {

        $this->descripcion = $descripcion;
        //$this->proveedor = new ArrayCollection();
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
    public function getProveedor(): Collection
    {
        return $this->proveedor;
    }

    public function addProveedor(Producto $proveedor): self
    {
        if (!$this->proveedor->contains($proveedor)) {
            $this->proveedor->add($proveedor);
            $proveedor->setProveedor($this);
        }

        return $this;
    }

    public function removeProveedor(Producto $proveedor): self
    {
        if ($this->proveedor->removeElement($proveedor)) {
            // set the owning side to null (unless already changed)
            if ($proveedor->getProveedor() === $this) {
                $proveedor->setProveedor(null);
            }
        }

        return $this;
    }


    public function __toString()
    {
        return $this->descripcion;
    }
}

<?php

namespace App\Entity;

use App\Repository\ProductoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductoRepository::class)]
class Producto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column]
    private ?int $codigo = null;

    #[ORM\Column(length: 200)]
    private ?string $descripcion_producto = null;

    #[ORM\Column]
    private ?float $precio = null;

    #[ORM\Column]
    private ?int $stock = null;

    #[ORM\Column]
    private ?int $iva = null;

    #[ORM\Column]
    private ?float $peso = null;

    #[ORM\ManyToOne(inversedBy: 'productos')]
    private ?Zona $zona = null;

    #[ORM\ManyToOne(inversedBy: 'proveedor')]
    private ?Proveedor $proveedor = null;

    #[ORM\ManyToOne(inversedBy: 'presentacion')]
    private ?Presentacion $presentacion = null;

    #[ORM\ManyToOne(inversedBy: 'marca')]
    private ?Marca $marca = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMarca(): ?int
    {
        return $this->id_marca;
    }

    public function setIdMarca(int $id_marca): self
    {
        $this->id_marca = $id_marca;

        return $this;
    }

    public function getIdPresentacion(): ?int
    {
        return $this->id_presentacion;
    }

    public function setIdPresentacion(int $id_presentacion): self
    {
        $this->id_presentacion = $id_presentacion;

        return $this;
    }

    public function getIdProveedor(): ?int
    {
        return $this->id_proveedor;
    }

    public function setIdProveedor(int $id_proveedor): self
    {
        $this->id_proveedor = $id_proveedor;

        return $this;
    }

    public function getIdZona(): ?int
    {
        return $this->id_zona;
    }

    public function setIdZona(int $id_zona): self
    {
        $this->id_zona = $id_zona;

        return $this;
    }

    public function getCodigo(): ?int
    {
        return $this->codigo;
    }

    public function setCodigo(int $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getDescripcionProducto(): ?string
    {
        return $this->descripcion_producto;
    }

    public function setDescripcionProducto(string $descripcion_producto): self
    {
        $this->descripcion_producto = $descripcion_producto;

        return $this;
    }

    public function getPrecio(): ?float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getIva(): ?int
    {
        return $this->iva;
    }

    public function setIva(int $iva): self
    {
        $this->iva = $iva;

        return $this;
    }

    public function getPeso(): ?float
    {
        return $this->peso;
    }

    public function setPeso(float $peso): self
    {
        $this->peso = $peso;

        return $this;
    }

    public function getZona(): ?Zona
    {
        return $this->zona;
    }

    public function setZona(?Zona $zona): self
    {
        $this->zona = $zona;

        return $this;
    }

    public function getProveedor(): ?Proveedor
    {
        return $this->proveedor;
    }

    public function setProveedor(?Proveedor $proveedor): self
    {
        $this->proveedor = $proveedor;

        return $this;
    }

    public function getPresentacion(): ?Presentacion
    {
        return $this->presentacion;
    }

    public function setPresentacion(?Presentacion $presentacion): self
    {
        $this->presentacion = $presentacion;

        return $this;
    }

    public function getMarca(): ?Marca
    {
        return $this->marca;
    }

    public function setMarca(?Marca $marca): self
    {
        $this->marca = $marca;

        return $this;
    }
}

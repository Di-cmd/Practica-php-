<?php

namespace App\Entity;

use App\Repository\CategoriaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoriaRepository::class)
 */
class Categoria
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
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity=Producto::class, mappedBy="Categoria")
     */
    private $productos;





     public function __construct($nombre=null)
     {
        $this->nombre=$nombre;
        $this->productos=new ArrayCollection();
     }



 

    public function getId(): ?int
    {
        return $this->id;
    }



    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre=null): self
    {
        $this->nombre = $nombre;

        return $this;
    }


    public function AgregarProducto(Producto $producto)
    
    {
        $this->productos[]=$producto;
    }

    /**
     * @return Collection<int, Producto>
     */
    public function getProductos(): Collection
    {
        return $this->productos;
    }

    public function addProducto(Producto $producto): self
    {
        if (!$this->productos->contains($producto)) {
            $this->productos[] = $producto;
            $producto->setCategoria($this);
        }

        return $this;
    }

    public function removeProducto(Producto $producto): self
    {
        if ($this->productos->removeElement($producto)) {
            // set the owning side to null (unless already changed)
            if ($producto->getCategoria() === $this) {
     
            }
        }
        
        return $this;
    }
}

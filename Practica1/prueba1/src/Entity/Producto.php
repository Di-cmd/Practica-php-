<?php

namespace App\Entity;

use App\Repository\ProductoRepository;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=ProductoRepository::class)
 */
class Producto
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
     * @ORM\Column(type="string", length=255)
     */
    private $codigo;

    /**
     * @ORM\ManyToOne(targetEntity=Categoria::class, inversedBy="productos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categoria;



    // si no queremos repetir siempre los mismo metodos es neceario crear un constructor
    public function __construct($nombre=null,$codigo=null){
            $this->nombre=$nombre;
            $this->codigo=$codigo;
    }

 
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    //Para crear un nuevo metodo get es el que permite que se muestre el campo 
     public function getCodigo():?string
     {
        return $this->codigo; 
     }
     
     // es el que permite que se pueda modificar el campo. 
    public function setCodigo(string $codigo): self
    {
        $this->codigo = $codigo;
        return $this;
    }


    public function getCategoria()
    {
        return $this->categoria;
    }

    public function setCategoria(Categoria $categoria)
    {
      $this->categoria=$categoria;
    }



}

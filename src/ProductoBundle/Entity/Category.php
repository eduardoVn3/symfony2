<?php

namespace ProductoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="ProductoBundle\Repository\CategoryRepository")
 */
class Category implements \jsonSerializable
{

    public function jsonSerialize()
    {
        return [
            'id'=>$this->getId(),
            'name'=>$this->getName()
        ];
    }
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
    *@ORM\ManyToMany(targetEntity="Producto",mappedBy="categories")
    *@ORM\JoinTable(name="product_category")
    */
    private $producto = null;

    public function __construct()
    {
        $this->producto = new ArrayCollection();
    }

    public function getProducto($value='')
    {
        return $this->producto;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function __toString()
    {
        return $this->name;
    }
}


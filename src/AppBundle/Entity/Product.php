<?php

namespace AppBundle\Entity;

use AppBundle\Entity\ProductCategory;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
 * @UniqueEntity("code", message="Este código ya se está usando en otro producto")
 * @UniqueEntity("name", message="Ya existe otro producto con este nombre")
 */
class Product
{
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
     * @ORM\Column(name="code", type="string", length=100, unique=true)
     * @NotBlank(message="Por favor, indique un código")
     * @Regex(
     *     "/^[a-z0-9\-]+$/i", 
     *     message="El código no puede contener caracteres especiales ni espacios en blanco"
     * )
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @NotBlank(message="Por favor, indique un nombre")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     * @NotBlank(message="Por favor, indique una descripción")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="brand", type="string", length=255)
     * @NotBlank(message="Por favor, indique una marca")
     */
    private $brand;

    /**
     * @var ProductCategory
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ProductCategory")
     * @NotBlank(message="Por favor, seleccione una categoría")
     */
    private $category;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     * @NotBlank(message="Por favor, indique un precio")
     */
    private $price;

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
     * Set code
     *
     * @param string $code
     *
     * @return Product
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Product
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

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set brand
     *
     * @param string $brand
     *
     * @return Product
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @return ProductCategory
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return Product
     */
    public function setCategory(ProductCategory $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }
}

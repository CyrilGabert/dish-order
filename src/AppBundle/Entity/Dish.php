<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Dish
 *
 * @ORM\Table(name="dish")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DishRepository")
 */
class Dish
{
    const CATEGORY_ENTREES = 'entrees';
    const CATEGORY_DISHES = 'dishes';
    const CATEGORY_DESSERTS = 'desserts';

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
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=255)
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2)
     */
    private $price;

    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="TableOrderLine", mappedBy="dish")
     */
    private $tableOrderLines;

    public function __construct()
    {
        $this->tableOrderLines = new ArrayCollection();
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
     * @return Dish
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
     * Set category
     *
     * @param string $category
     *
     * @return Dish
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Dish
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Add tableOrderLine
     *
     * @param \AppBundle\Entity\TableOrderLine $tableOrderLine
     *
     * @return Dish
     */
    public function addTableOrderLine(\AppBundle\Entity\TableOrderLine $tableOrderLine)
    {
        $this->tableOrderLines[] = $tableOrderLine;

        return $this;
    }

    /**
     * Remove tableOrderLine
     *
     * @param \AppBundle\Entity\TableOrderLine $tableOrderLine
     */
    public function removeTableOrderLine(\AppBundle\Entity\TableOrderLine $tableOrderLine)
    {
        $this->tableOrderLines->removeElement($tableOrderLine);
    }

    /**
     * Get tableOrderLines
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTableOrderLines()
    {
        return $this->tableOrderLines;
    }
}

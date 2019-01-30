<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TableOrderLine
 *
 * @ORM\Table(name="table_order_line")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TableOrderLineRepository")
 */
class TableOrderLine
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
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @var Dish
     *
     * @ORM\ManyToOne(targetEntity="Dish", inversedBy="tableOrderLines")
     * @ORM\JoinColumn(name="dish_id", referencedColumnName="id")
     */
    private $dish;
    
    /**
     * @var TableOrder
     *
     * @ORM\ManyToOne(targetEntity="TableOrder", inversedBy="tableOrderLines")
     * @ORM\JoinColumn(name="table_order_id", referencedColumnName="id")
     */
    private $tableOrder;

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
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return TableOrderLine
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set dish
     *
     * @param \AppBundle\Entity\Dish $dish
     *
     * @return TableOrderLine
     */
    public function setDish(\AppBundle\Entity\Dish $dish = null)
    {
        $this->dish = $dish;

        return $this;
    }

    /**
     * Get dish
     *
     * @return \AppBundle\Entity\Dish
     */
    public function getDish()
    {
        return $this->dish;
    }

    /**
     * Set tableOrder
     *
     * @param \AppBundle\Entity\TableOrder $tableOrder
     *
     * @return TableOrderLine
     */
    public function setTableOrder(\AppBundle\Entity\TableOrder $tableOrder = null)
    {
        $this->tableOrder = $tableOrder;

        return $this;
    }

    /**
     * Get tableOrder
     *
     * @return \AppBundle\Entity\TableOrder
     */
    public function getTableOrder()
    {
        return $this->tableOrder;
    }
}

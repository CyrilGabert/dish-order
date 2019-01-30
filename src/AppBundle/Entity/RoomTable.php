<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * RoomTable
 *
 * @ORM\Table(name="room_table")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RoomTableRepository")
 */
class RoomTable
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;
    
    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="TableOrder", mappedBy="roomTable")
     */
    private $tableOrders;
    
    public function __construct()
    {
        $this->tableOrders = new ArrayCollection();
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
     * @return RoomTable
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
     * Add tableOrder
     *
     * @param \AppBundle\Entity\TableOrder $tableOrder
     *
     * @return RoomTable
     */
    public function addTableOrder(\AppBundle\Entity\TableOrder $tableOrder)
    {
        $this->tableOrders[] = $tableOrder;

        return $this;
    }

    /**
     * Remove tableOrder
     *
     * @param \AppBundle\Entity\TableOrder $tableOrder
     */
    public function removeTableOrder(\AppBundle\Entity\TableOrder $tableOrder)
    {
        $this->tableOrders->removeElement($tableOrder);
    }

    /**
     * Get tableOrders
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTableOrders()
    {
        return $this->tableOrders;
    }
}

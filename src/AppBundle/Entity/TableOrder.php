<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * TableOrder
 *
 * @ORM\Table(name="table_order")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TableOrderRepository")
 */
class TableOrder
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
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var RoomTable
     *
     * @ORM\ManyToOne(targetEntity="RoomTable", inversedBy="tableOrders")
     * @ORM\JoinColumn(name="room_table_id", referencedColumnName="id")
     */
    private $roomTable;
     
    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="TableOrderLine", mappedBy="tableOrder")
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return TableOrder
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set roomTable
     *
     * @param \AppBundle\Entity\RoomTable $roomTable
     *
     * @return TableOrder
     */
    public function setRoomTable(\AppBundle\Entity\RoomTable $roomTable = null)
    {
        $this->roomTable = $roomTable;

        return $this;
    }

    /**
     * Get roomTable
     *
     * @return \AppBundle\Entity\RoomTable
     */
    public function getRoomTable()
    {
        return $this->roomTable;
    }

    /**
     * Add tableOrderLine
     *
     * @param \AppBundle\Entity\TableOrderLine $tableOrderLine
     *
     * @return TableOrder
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

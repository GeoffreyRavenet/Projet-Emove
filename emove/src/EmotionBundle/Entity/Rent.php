<?php

namespace EmotionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rent
 *
 * @ORM\Table(name="rent")
 * @ORM\Entity(repositoryClass="EmotionBundle\Repository\RentRepository")
 */
class Rent
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
     * @var \Date
     *
     * @ORM\Column(name="date_rental", type="date")
     */
    private $dateRental;

    /**
     * @var \Date
     *
     * @ORM\Column(name="date_delivery", type="date")
     */
    private $dateDelivery;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="users")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param mixed $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="products")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;

    /**
     * @var int
     *
     * @ORM\Column(name="total_price", type="integer")
     */
    private $totalPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="invoice", type="string", length=255)
     */
    private $invoice;


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
     * Set dateRental
     *
     * @param \DateTime $dateRental
     *
     * @return Rent
     */
    public function setDateRental($dateRental)
    {
        $this->dateRental = $dateRental;

        return $this;
    }

    /**
     * Get dateRental
     *
     * @return \DateTime
     */
    public function getDateRental()
    {
        return $this->dateRental;
    }

    /**
     * Set dateDelivery
     *
     * @param \DateTime $dateDelivery
     *
     * @return Rent
     */
    public function setDateDelivery($dateDelivery)
    {
        $this->dateDelivery = $dateDelivery;

        return $this;
    }

    /**
     * Get dateDelivery
     *
     * @return \DateTime
     */
    public function getDateDelivery()
    {
        return $this->dateDelivery;
    }
	
    /**
     * Set totalPrice
     *
     * @param integer $totalPrice
     *
     * @return Rent
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    /**
     * Get totalPrice
     *
     * @return int
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * Set invoice
     *
     * @param string $invoice
     *
     * @return Rent
     */
    public function setInvoice($invoice)
    {
        $this->invoice = $invoice;

        return $this;
    }

    /**
     * Get invoice
     *
     * @return string
     */
    public function getInvoice()
    {
        return $this->invoice;
    }
	
	public function getCar()
	{
		return $this->product;
	}
}


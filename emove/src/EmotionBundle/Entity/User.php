<?php

namespace EmotionBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="EmotionBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


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
     * @ORM\Column(type="string")
     */
    private $firstName;

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }


    /**
     * @ORM\Column(type="string")
     */
    private $name;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @ORM\Column(type="date")
     */
    private $birthdate;

    public function getBirthdate()
    {
        return $this->birthdate;
    }

    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $zipCode;

    public function getZipCode()
    {
        return $this->zipCode;
    }

    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
    }

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $country;

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phone;

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $driverLicence;

    public function getDriverLicence()
    {
        return $this->driverLicence;
    }

    public function setDriverLicence($driverLicence)
    {
        $this->driverLicence = $driverLicence;
    }

    /**
     * @ORM\Column(type="integer")
     */
    private $loyaltyPoints;

    public function getLoyaltyPoints()
    {
        return $this->loyaltyPoints;
    }

    public function setLoyaltyPoints($loyaltyPoints)
    {
        $this->loyaltyPoints = $loyaltyPoints;
    }


    /**
     * Overridden so that username is now optional
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->setUsername($email);
        return parent::setEmail($email);
    }

    /**
     * @ORM\OneToMany(targetEntity="Rent", mappedBy="rent")
     */
    private $rents;

    public function __construct()
    {
        $this->rents = new ArrayCollection();
    }
}


<?php

namespace EmotionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="EmotionBundle\Repository\ProductRepository")
 * @Vich\Uploadable
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="serial_number", type="string", length=255)
     */
    private $serialNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=255)
     */
    private $color;


    /**
     * @var string
     *
     * @ORM\Column(name="numberplate", type="string", length=255)
     */
    private $numberplate;

    /**
     * @var float
     *
     * @ORM\Column(name="km_number", type="float")
     */
    private $kmNumber;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="purchase_date", type="datetime")
     */
    private $purchaseDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="availability_date", type="datetime")
     */
    private $availabilityDate;

    /**
     * @var \Date
     *
     * @ORM\Column(name="year", type="date")
     */
    private $year;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var int
     *
     * @ORM\Column(name="price_buy", type="integer")
     */
    private $price_buy;

    /**
     * @return mixed
     */
    public function getPriceBuy()
    {
        return $this->price_buy;
    }

    /**
     * @param mixed $price_buy
     */
    public function setPriceBuy($price_buy)
    {
        $this->price_buy = $price_buy;
    }

    /**
     * @ORM\ManyToOne(targetEntity="ProductCategory", inversedBy="products")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="Brand", inversedBy="brands")
     * @ORM\JoinColumn(name="brand_id", referencedColumnName="id")
     */
    private $brand;

    /**
     * @ORM\ManyToOne(targetEntity="Agency", inversedBy="agencies")
     * @ORM\JoinColumn(name="agency_id", referencedColumnName="id")
     */
    private $agency;

    /**
     * @return mixed
     */
    public function getAgency()
    {
        return $this->agency;
    }

    /**
     * @param mixed $agency
     */
    public function setAgency($agency)
    {
        $this->agency = $agency;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Model", inversedBy="models")
     * @ORM\JoinColumn(name="model_id", referencedColumnName="id")
     */
    private $model;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="Rent", mappedBy="rent")
     */
    private $rents;

    public function __construct()
    {
        $this->rents = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param mixed $brand
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
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
     * @return string
     */
    public function getSerialNumber()
    {
        return $this->serialNumber;
    }

    /**
     * @param string $serialNumber
     */
    public function setSerialNumber($serialNumber)
    {
        $this->serialNumber = $serialNumber;
    }

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }


    /**
     * @return string
     */
    public function getNumberplate()
    {
        return $this->numberplate;
    }

    /**
     * @param string $numberplate
     */
    public function setNumberplate($numberplate)
    {
        $this->numberplate = $numberplate;
    }

    /**
     * @return float
     */
    public function getKmNumber()
    {
        return $this->kmNumber;
    }

    /**
     * @param float $kmNumber
     */
    public function setKmNumber($kmNumber)
    {
        $this->kmNumber = $kmNumber;
    }

    /**
     * @return \DateTime
     */
    public function getPurchaseDate()
    {
        return $this->purchaseDate;
    }

    /**
     * @param \DateTime $purchaseDate
     */
    public function setPurchaseDate($purchaseDate)
    {
        $this->purchaseDate = $purchaseDate;
    }

    /**
     * @return \DateTime
     */
    public function getAvailabilityDate()
    {
        return $this->availabilityDate;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @return string
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return float
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @param \DateTime $availabilityDate
     */
    public function setAvailabilityDate($availabilityDate)
    {
        $this->availabilityDate = $availabilityDate;
    }

    public function showAction($productId)
    {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($productId);

        $categoryName = $product->getCategory()->getName();
    }

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }
}
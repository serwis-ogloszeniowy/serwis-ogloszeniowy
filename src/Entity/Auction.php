<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AuctionRepository")
 */
class Auction
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="date")
     */
    private $dateOfCreation;

    /**
     * @ORM\Column(type="date")
     */
    private $dateOfUpdate;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="auctions")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="Image", mappedBy="auction", cascade={"persist"}, fetch="EAGER")
     */
    private $images;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="auctions")
     */
    private $category;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
    
    public function getPrice(): ?int
    {
        return $this->price;
    }
    
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    public function getDateOfCreation(): ?\DateTimeInterface
    {
        return $this->dateOfCreation;
    }

    public function setDateOfCreation(\DateTimeInterface $dateOfCreation): self
    {
        $this->dateOfCreation = $dateOfCreation;

        return $this;
    }

    public function getDateOfUpdate(): ?\DateTimeInterface
    {
        return $this->dateOfUpdate;
    }

    public function setDateOfUpdate(\DateTimeInterface $dateOfUpdate): self
    {
        $this->dateOfUpdate = $dateOfUpdate;

        return $this;
    }

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
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return ArrayCollection
     */
    public function getImages()
    {
        return $this->images;
    }
    
    public function setImages($images): void
    {
        $this->images[] = $images;
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
    public function setCategory($category): void
    {
        $this->category = $category;
    }

    public function getImagesArray()
    {
        $ar = [];

        foreach ($this->images as $image)
        {
            $ar[] =$image;
        }

        return $ar;
    }

    public function getFirstImage()
    {
        foreach ($this->images as $image) {
           return $image->getPath();
        }
        return null;
    }

    public function getCategoryName()
    {
        return $this->category->getName();
    }

    public function getUserPhoneNumber()
    {
        return $this->user->getPhone();
    }

    public function getUserEmail()
    {
        return $this->user->getEmail();
    }

    public function countImages()
    {
        $i = -1;

        foreach ($this->getImages() as $image) {
               $i++;
        }
        return $i;
    }
}

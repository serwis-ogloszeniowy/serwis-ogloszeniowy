<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_of_creation;

    /**
     * @ORM\OneToMany(targetEntity="Auction", mappedBy="category")
     */
    private $auctions;

    public function __construct()
    {
        $this->auctions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getDateOfCreation(): ?\DateTimeInterface
    {
        return $this->date_of_creation;
    }

    public function setDateOfCreation(?\DateTimeInterface $date_of_creation): self
    {
        $this->date_of_creation = $date_of_creation;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getAuctions(): ArrayCollection
    {
        return $this->auctions;
    }

    /**
     * @param ArrayCollection $auctions
     */
    public function setAuctions(ArrayCollection $auctions): void
    {
        $this->auctions = $auctions;
    }
}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 */
class Image
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
    private $path;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $filename;

    /**
     * @ORM\Column(type="date")
     */
    private $dateOfCreation;

    /**
     * @ORM\Column(type="date")
     */
    private $dateOfLastModification;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     */
    private $mainImage;

    /**
     * @ORM\ManyToOne(targetEntity="Auction", inversedBy="images")
     */
    private $auction;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
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

    public function getDateOfLastModification(): ?\DateTimeInterface
    {
        return $this->dateOfLastModification;
    }

    public function setDateOfLastModification(\DateTimeInterface $dateOfLastModification): self
    {
        $this->dateOfLastModification = $dateOfLastModification;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMainImage()
    {
        return $this->mainImage;
    }

    /**
     * @param mixed $mainImage
     */
    public function setMainImage($mainImage): void
    {
        $this->mainImage = $mainImage;
    }

    /**
     * @return mixed
     */
    public function getAuction()
    {
        return $this->auction;
    }

    /**
     * @param mixed $auction
     */
    public function setAuction($auction): void
    {
        $this->auction = $auction;
    }
}

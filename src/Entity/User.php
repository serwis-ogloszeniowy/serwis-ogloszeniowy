<?php

declare(strict_types = 1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Validator as CustomAssert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=59)
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min=2,
     *     max=22,
     *     minMessage="Imię musi zawierać co najmniej 2 znaki",
     *     maxMessage="Imię może zawierać maksymalnie 22 znaki"
     *     )
     * @CustomAssert\Name
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min=2,
     *     max=50,
     *     minMessage="Nazwisko musi zawierać co najmniej 2 znaki",
     *     minMessage="Login musi zawierać co najmniej 22 znaki",
     *     )
     * @CustomAssert\Name
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min=3,
     *      max=20,
     *     minMessage="Login musi zawierać co najmniej 3 znaki",
     *     maxMessage="Login może zawierać maksymalnie 20 znaków"
     *     )
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Email(
     *     message = "Podaj poprawny adres email"
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @CustomAssert\Phone
     */
    private $phone;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $role;

    /**
     * @ORM\Column(type="date", nullable=false)
     */
    private $dateOfRegistration;

    /**
     * @Assert\Length(min=5, max=4096, minMessage="Hasło musi zawierać co najmniej 5 znaków")
     */
    private $plainPassword;

    private $oldPassword;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Auction", mappedBy="user", cascade={"persist"})
     */
    private $auctions;

    public function __construct()
    {
        $this->auctions = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role): void
    {
        $this->role = $role;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }

    public function getOldPassword(): ?string
    {
        return $this->oldPassword;
    }
    
    public function setOldPassword(string $oldPassword): void
    {
        $this->oldPassword = $oldPassword;
    }

    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->login,
            $this->password
        ));
    }

    public function unserialize($serialized)
    {
        list($this->id,
            $this->login,
            $this->password) = unserialize($serialized);
    }

    public function getRoles()
    {
        return [
            $this->getRole()
        ];
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername(): string
    {
        return $this->login;
    }

    public function eraseCredentials()
    {
        unset($this->plainPassword);
    }

    /**
     * @return mixed
     */
    public function getDateOfRegistration()
    {
        return $this->dateOfRegistration;
    }

    /**
     * @param mixed $dateOfRegistration
     */
    public function setDateOfRegistration($dateOfRegistration): void
    {
        $this->dateOfRegistration = $dateOfRegistration;
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

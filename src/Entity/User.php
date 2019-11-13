<?php

declare(strict_types = 1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

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
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=50)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=50)
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank()
     * @Assert\Length(min=5, max=20)
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Count(min=9, max=9, minMessage="You must add 9 digits")
     */
    private $phone;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=5, max=4096)
     */
    private $plainPassword;
    
    private $oldPassword;

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

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(?int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }
    
    public function getPlainPassword(): string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }

    public function getOldPassword(): string
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
            'ROLE_USER'
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
}

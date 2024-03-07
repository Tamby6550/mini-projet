<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 * @UniqueEntity(fields={"email"}, message="Cet email est déjà utilisé.")
 */
class Users implements UserInterface  
{
    // Existing code...
    /**
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Email
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $number_siret;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone_number;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name_company;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $company_phone_number;

    /**
     * @ORM\Column(type="array")
     */
    private $Role = [];

    /**
     * @ORM\ManyToMany(targetEntity=Company::class, mappedBy="userId")
     */
    private $companies;

    public function __construct()
    {
        $this->companies = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

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

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

      /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }


    public function getNumberSiret(): ?string
    {
        return $this->number_siret;
    }

    public function setNumberSiret(?string $number_siret): self
    {
        $this->number_siret = $number_siret;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(?string $phone_number): self
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    public function getNameCompany(): ?string
    {
        return $this->name_company;
    }

    public function setNameCompany(?string $name_company): self
    {
        $this->name_company = $name_company;

        return $this;
    }

    public function getCompanyPhoneNumber(): ?string
    {
        return $this->company_phone_number;
    }

    public function setCompanyPhoneNumber(?string $company_phone_number): self
    {
        $this->company_phone_number = $company_phone_number;

        return $this;
    }

    public function getRoles(): ?array
    {
        return $this->Role;
    }

    public function setRole(array $Role): self
    {
        $this->Role = $Role;

        return $this;
    }

   

    public function getSalt()
    {
        // Add your logic here if needed
        // For example, if you're using bcrypt for password hashing, you can return null
        return null;
    }

    public function eraseCredentials()
    {
        // Add your logic here if needed
        // For example, if you're storing plain text passwords temporarily, you can clear them here
        // Otherwise, you can leave this method empty
    }

    /**
     * @return Collection<int, Company>
     */
    public function getCompanies(): Collection
    {
        return $this->companies;
    }

    public function addCompany(Company $company): self
    {
        if (!$this->companies->contains($company)) {
            $this->companies[] = $company;
            $company->addUserId($this);
        }

        return $this;
    }

    public function removeCompany(Company $company): self
    {
        if ($this->companies->removeElement($company)) {
            $company->removeUserId($this);
        }

        return $this;
    }
}

 
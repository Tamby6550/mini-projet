<?php

namespace App\Entity;

use App\Repository\UsersStandardRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UsersStandardRepository::class)
 */
class UsersStandard
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
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
    private $age;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="usersStandards")
     */
    private $companyCurrent;

    /**
     *  @ORM\Column(type="string", length=255)
     */
    private $acces_role ;

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

    public function getAge(): ?string
    {
        return $this->age;
    }

    public function setAge(string $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getCompanyCurrent(): ?Company
    {
        return $this->companyCurrent;
    }

    public function setCompanyCurrent(?Company $companyCurrent): self
    {
        $this->companyCurrent = $companyCurrent;

        return $this;
    }

    public function getAccesRole(): ?string
    {
        return $this->acces_role;
    }

    public function setAccesRole(string $acces_role): self
    {
        $this->acces_role = $acces_role;

        return $this;
    }
}

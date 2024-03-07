<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompanyRepository::class)
 */
class Company
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $turnover;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $website;

    /**
     * @ORM\ManyToMany(targetEntity=Users::class, inversedBy="companies")
     */
    private $userId;

    /**
     * @ORM\OneToMany(targetEntity=UsersStandard::class, mappedBy="companyCurrent",  cascade={"persist"})
     */
    private $usersStandards;

    public function __construct()
    {
        $this->userId = new ArrayCollection();
        $this->usersStandards = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getTurnover(): ?string
    {
        return $this->turnover;
    }

    public function setTurnover(?string $turnover): self
    {
        $this->turnover = $turnover;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(string $website): self
    {
        $this->website = $website;

        return $this;
    }

    /**
     * @return Collection<int, Users>
     */
    public function getUserId(): Collection
    {
        return $this->userId;
    }

    public function addUserId(Users $userId): self
    {
        if (!$this->userId->contains($userId)) {
            $this->userId[] = $userId;
        }

        return $this;
    }

    public function removeUserId(Users $userId): self
    {
        $this->userId->removeElement($userId);

        return $this;
    }

    /**
     * @return Collection<int, UsersStandard>
     */
    public function getUsersStandards(): Collection
    {
        return $this->usersStandards;
    }

    public function addUsersStandard(UsersStandard $usersStandard): self
    {
        if (!$this->usersStandards->contains($usersStandard)) {
            $this->usersStandards[] = $usersStandard;
            $usersStandard->setCompanyCurrent($this);
        }

        return $this;
    }

    public function removeUsersStandard(UsersStandard $usersStandard): self
    {
        if ($this->usersStandards->removeElement($usersStandard)) {
            // set the owning side to null (unless already changed)
            if ($usersStandard->getCompanyCurrent() === $this) {
                $usersStandard->setCompanyCurrent(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        // return a string representation of the Company object
        // for example, you might return the company's name
        return $this->logo;
    }
}

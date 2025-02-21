<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;


#[ORM\Entity(repositoryClass: AdminRepository::class)]
#[ApiResource]
class Admin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'admin')]
    private Collection $employees;

    /**
     * @var Collection<int, Stats>
     */
    #[ORM\OneToMany(targetEntity: Stats::class, mappedBy: 'admin')]
    private Collection $stats;

    public function __construct()
    {
        $this->employees = new ArrayCollection();
        $this->stats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, User>
     */
    public function getEmployees(): Collection
    {
        return $this->employees;
    }

    public function addEmployee(User $employee): static
    {
        if (!$this->employees->contains($employee)) {
            $this->employees->add($employee);
            $employee->setAdmin($this);
        }

        return $this;
    }

    public function removeEmployee(User $employee): static
    {
        if ($this->employees->removeElement($employee)) {
            // set the owning side to null (unless already changed)
            if ($employee->getAdmin() === $this) {
                $employee->setAdmin(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Stats>
     */
    public function getStats(): Collection
    {
        return $this->stats;
    }

    public function addStat(Stats $stat): static
    {
        if (!$this->stats->contains($stat)) {
            $this->stats->add($stat);
            $stat->setAdmin($this);
        }

        return $this;
    }

    public function removeStat(Stats $stat): static
    {
        if ($this->stats->removeElement($stat)) {
            // set the owning side to null (unless already changed)
            if ($stat->getAdmin() === $this) {
                $stat->setAdmin(null);
            }
        }

        return $this;
    }
}

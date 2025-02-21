<?php

namespace App\Entity;


use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource]

class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $role = null;

    #[ORM\Column]
    private ?int $credit = null;

    /**
     * @var Collection<int, Ride>
     */
    #[ORM\OneToMany(targetEntity: Ride::class, mappedBy: 'driver')]
    private Collection $rides;

    /**
     * @var Collection<int, Car>
     */
    #[ORM\OneToMany(targetEntity: Car::class, mappedBy: 'driver')]
    private Collection $cars;

    /**
     * @var Collection<int, Booking>
     */
    #[ORM\OneToMany(targetEntity: Booking::class, mappedBy: 'passenger')]
    private Collection $bookings;

    /**
     * @var Collection<int, Rating>
     */
    #[ORM\OneToMany(targetEntity: Rating::class, mappedBy: 'driver')]
    private Collection $ratings;

    #[ORM\ManyToOne(inversedBy: 'employees')]
    private ?Admin $admin = null;

    /**
     * @var Collection<int, Ride>
     */
    #[ORM\OneToMany(targetEntity: Ride::class, mappedBy: 'user')]
    private Collection $driverRides;

    public function __construct()
    {
        $this->rides = new ArrayCollection();
        $this->cars = new ArrayCollection();
        $this->bookings = new ArrayCollection();
        $this->ratings = new ArrayCollection();
        $this->driverRides = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getCredit(): ?int
    {
        return $this->credit;
    }

    public function setCredit(int $credit): static
    {
        $this->credit = $credit;

        return $this;
    }

    /**
     * @return Collection<int, Ride>
     */
    public function getRides(): Collection
    {
        return $this->rides;
    }

    public function addRide(Ride $ride): static
    {
        if (!$this->rides->contains($ride)) {
            $this->rides->add($ride);
            $ride->setDriver($this);
        }

        return $this;
    }

    public function removeRide(Ride $ride): static
    {
        if ($this->rides->removeElement($ride)) {
            // set the owning side to null (unless already changed)
            if ($ride->getDriver() === $this) {
                $ride->setDriver(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Car>
     */
    public function getCars(): Collection
    {
        return $this->cars;
    }

    public function addCar(Car $car): static
    {
        if (!$this->cars->contains($car)) {
            $this->cars->add($car);
            $car->setDriver($this);
        }

        return $this;
    }

    public function removeCar(Car $car): static
    {
        if ($this->cars->removeElement($car)) {
            // set the owning side to null (unless already changed)
            if ($car->getDriver() === $this) {
                $car->setDriver(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Booking>
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking): static
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings->add($booking);
            $booking->setPassenger($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): static
    {
        if ($this->bookings->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getPassenger() === $this) {
                $booking->setPassenger(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Rating>
     */
    public function getRatings(): Collection
    {
        return $this->ratings;
    }

    public function addRating(Rating $rating): static
    {
        if (!$this->ratings->contains($rating)) {
            $this->ratings->add($rating);
            $rating->setDriver($this);
        }

        return $this;
    }

    public function removeRating(Rating $rating): static
    {
        if ($this->ratings->removeElement($rating)) {
            // set the owning side to null (unless already changed)
            if ($rating->getDriver() === $this) {
                $rating->setDriver(null);
            }
        }

        return $this;
    }

    public function getAdmin(): ?Admin
    {
        return $this->admin;
    }

    public function setAdmin(?Admin $admin): static
    {
        $this->admin = $admin;

        return $this;
    }

    /**
     * @return Collection<int, Ride>
     */
    public function getDriverRides(): Collection
    {
        return $this->driverRides;
    }

    public function addDriverRide(Ride $driverRide): static
    {
        if (!$this->driverRides->contains($driverRide)) {
            $this->driverRides->add($driverRide);
            $driverRide->setUser($this);
        }

        return $this;
    }

    public function removeDriverRide(Ride $driverRide): static
    {
        if ($this->driverRides->removeElement($driverRide)) {
            // set the owning side to null (unless already changed)
            if ($driverRide->getUser() === $this) {
                $driverRide->setUser(null);
            }
        }

        return $this;
    }
}

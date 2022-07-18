<?php

namespace Infrastructure\Entity\Booking;

use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Infrastructure\Entity\Common\Uuid;
use Infrastructure\Repository\Booking\BookingRepository;

#[ORM\Entity(repositoryClass: BookingRepository::class)]
class Booking
{
    use Uuid;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'json')]
    private array $person = [];

    #[ORM\Column(type: 'json')]
    private array $contacts = [];

    #[ORM\Column(type: 'string', length: 255)]
    private string $departure;

    #[ORM\Column(type: 'string', length: 255)]
    private string $destination;

    #[ORM\Column(type: 'datetime')]
    private DateTimeInterface $departureAt;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $bookedAt;

    #[ORM\Column(type: 'integer')]
    private int $seatNumber;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getPerson(): ?array
    {
        return $this->person;
    }

    public function setPerson(array $person): self
    {
        $this->person = $person;

        return $this;
    }

    public function getContacts(): ?array
    {
        return $this->contacts;
    }

    public function setContacts(array $contacts): self
    {
        $this->contacts = $contacts;

        return $this;
    }

    public function getDeparture(): ?string
    {
        return $this->departure;
    }

    public function setDeparture(string $departure): self
    {
        $this->departure = $departure;

        return $this;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setDestination(string $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getDepartureAt(): ?DateTimeInterface
    {
        return $this->departureAt;
    }

    public function setDepartureAt(DateTimeInterface $departureAt): self
    {
        $this->departureAt = $departureAt;

        return $this;
    }

    public function getBookedAt(): ?DateTimeImmutable
    {
        return $this->bookedAt;
    }

    public function setBookedAt(DateTimeImmutable $bookedAt): self
    {
        $this->bookedAt = $bookedAt;

        return $this;
    }

    public function getSeatNumber(): ?int
    {
        return $this->seatNumber;
    }

    public function setSeatNumber(int $seatNumber): self
    {
        $this->seatNumber = $seatNumber;

        return $this;
    }
}

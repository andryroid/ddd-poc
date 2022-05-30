<?php

namespace Infrastructure\Entity\Booking;

use Doctrine\ORM\Mapping as ORM;
use Domain\Utils\Entity\EntityInterface;
use Infrastructure\Repository\Booking\BookingRepository;

#[ORM\Entity(repositoryClass: BookingRepository::class)]
class Booking implements EntityInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $uuid;

    #[ORM\Column(type: 'json')]
    private $person = [];

    #[ORM\Column(type: 'json')]
    private $contacts = [];

    #[ORM\Column(type: 'string', length: 255)]
    private $departure;

    #[ORM\Column(type: 'string', length: 255)]
    private $destination;

    #[ORM\Column(type: 'datetime')]
    private $departure_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
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

    public function getDepartureAt(): ?\DateTimeInterface
    {
        return $this->departure_at;
    }

    public function setDepartureAt(\DateTimeInterface $departure_at): self
    {
        $this->departure_at = $departure_at;

        return $this;
    }
}

<?php

namespace Infrastructure\Entity\Booking;


use Infrastructure\Entity\Uuidable;
use Infrastructure\Repository\Booking\BookingRepository;
use Doctrine\ORM\Mapping as ORM;
use Infrastructure\Entity\Timestampable;

#[ORM\Table]
#[ORM\Entity(repositoryClass: BookingRepository::class)]
class Booking
{
    use Uuidable;
    use Timestampable;

    #[ORM\Column(name: 'id', type: 'integer')]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private int $id;
    #[ORM\Column(type: 'string', length: 50)]
    private string $firstName;
    #[ORM\Column(type: 'string', length: 50)]
    private string $lastName;

}

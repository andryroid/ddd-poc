<?php

namespace Infrastructure\Repository\Booking;

use Application\Booking\Transformer\BookingTransformerInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Business\Booking\Model\Booking as DomainBooking;
use Domain\Business\Booking\Model\Properties\BookingId;
use Domain\Business\Booking\Repository\BookingRepositoryInterface;
use Infrastructure\Entity\Booking\Booking;

class BookingRepository extends ServiceEntityRepository implements BookingRepositoryInterface
{
    public function __construct(ManagerRegistry $registry, private BookingTransformerInterface $bookingTransformer)
    {
        parent::__construct($registry, Booking::class);
    }


    public function save(DomainBooking $domainBooking): BookingId
    {
        $booking = $this->bookingTransformer->fromDomainToDb($domainBooking);
        //$this->_em->persist($booking);

        return $domainBooking->getUuid();
    }
}

<?php

namespace Infrastructure\Repository\Booking;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Business\Booking\Model\Booking as DomainBooking;
use Domain\Business\Booking\Repository\BookingAvailability;
use Infrastructure\Entity\Booking\Booking;

/**
 * @extends ServiceEntityRepository<Booking>
 *
 * @method Booking|null find($id, $lockMode = null, $lockVersion = null)
 * @method Booking|null findOneBy(array $criteria, array $orderBy = null)
 * @method Booking[]    findAll()
 * @method Booking[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookingAvailabilityRepository extends ServiceEntityRepository implements BookingAvailability
{
    public function __construct(ManagerRegistry $registry,private readonly BookingRepository $bookingRepository)
    {
        parent::__construct($registry, Booking::class);
    }

    public function isAvailable(DomainBooking $booking): bool
    {
        $bookingData = $booking->getSummary();
        return count($this->bookingRepository->findBy([
             'departure' => $bookingData['departure'],
             'destination' => $bookingData['destination'],
             'departure_at' => $bookingData['departure_time'],
        ])) === 0;
    }
}

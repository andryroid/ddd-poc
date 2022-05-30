<?php

namespace Infrastructure\Repository\Booking;

use Application\Booking\Transformer\BookingTransformerInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Business\Booking\Model\Booking as DomainBooking;
use Domain\Business\Booking\Model\Properties\BookingId;
use Domain\Business\Booking\Repository\BookingRepositoryInterface;
use Infrastructure\Service\Transformer\Booking\BookingTransformer;

/**
 * @extends ServiceEntityRepository<Booking>
 *
 * @method Booking|null find($id, $lockMode = null, $lockVersion = null)
 * @method Booking|null findOneBy(array $criteria, array $orderBy = null)
 * @method Booking[]    findAll()
 * @method Booking[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookingRepository extends ServiceEntityRepository implements BookingRepositoryInterface
{
    public function __construct(ManagerRegistry $registry,private BookingTransformerInterface $bookingTransformerInterface)
    {
        parent::__construct($registry, Booking::class);
    }

    public function save(DomainBooking $domainBooking) : BookingId
    {
        $entityBooking = $this->bookingTransformerInterface->fromDomainToDb($domainBooking);
        $this->_em->persist($entityBooking);
        return $domainBooking->getUuid();
    }
}

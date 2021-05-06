<?php


namespace App\Repository;

use App\Entity\QueuingPlayer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method QueuingPlayer|null find($id, $lockMode = null, $lockVersion = null)
 * @method QueuingPlayer|null findOneBy(array $criteria, array $orderBy = null)
 * @method QueuingPlayer[]    findAll()
 * @method QueuingPlayer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QueuingPlayerRepository extends  ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QueuingPlayer::class);
    }

    public function persist(QueuingPlayer $queuingPlayer) {
        $this->_em->persist($queuingPlayer);
    }

    public function flush(): void
    {
        $this->_em->flush();
    }

    public function remove(QueuingPlayer $queuingPlayer)
    {
        $this->_em->remove($queuingPlayer);
    }
}
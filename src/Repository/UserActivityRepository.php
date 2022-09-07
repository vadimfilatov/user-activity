<?php

namespace App\Repository;

use App\DTO\Query\UserActivityQueryDTO;
use App\DTO\QueryResultDTO;
use App\Entity\UserActivity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserActivity>
 *
 * @method UserActivity|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserActivity|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserActivity[]    findAll()
 * @method UserActivity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserActivityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserActivity::class);
    }

    public function add(UserActivity $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(UserActivity $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function query(UserActivityQueryDTO $queryDTO): QueryResultDTO
    {
        $query = $this->createQueryBuilder('UA');

        if($queryDTO->getUserIds()) {
            $query->andWhere('UA.user_id in (:userIds)');
            $query->setParameter("userIds", $queryDTO->getUserIds());
        }

        if($queryDTO->getActions()) {
            $query->andWhere('UA.actions in (:actions)');
            $query->setParameter("actions", $queryDTO->getActions());
        }

        if($queryDTO->getDateFrom()) {
            $query->andWhere('UA.date > :date_from')
                ->setParameter("date_from", $queryDTO->getDateFrom());
        }

        if($queryDTO->getDateTo()) {
            $query->andWhere('UA.date < :date_to')
                ->setParameter("date_to", $queryDTO->getDateTo());
        }

        $result = (new QueryResultDTO())
            ->setCount($query->select("count(UA.id)")->getQuery()->getSingleScalarResult());

        $query
            ->select('UA', 'U.username')
            ->leftJoin('App\Entity\User', 'U', Join::WITH, 'U.id = UA.user_id')
            ->setMaxResults($queryDTO->getPerPage())
            ->setFirstResult(($queryDTO->getPage() - 1) * $queryDTO->getPerPage());

        if($queryDTO->getOrderBy() && $queryDTO->getOrderDir()) {
            $query->orderBy($queryDTO->getOrderBy(), $queryDTO->getOrderDir());
        }

        return $result
            ->setResult($query->getQuery()->getArrayResult());
    }

    public function getDataForReport(): array
    {
        $dates = array_column($this->createQueryBuilder("UA")
            ->select("DATE(UA.date) as date")
            ->where("UA.date >= :date")
            ->setParameter("date", date("Y-m-d 00:00:00", strtotime("-1 month")))
            ->groupBy("date")
            ->orderBy("date", "DESC")
            ->getQuery()
            ->getArrayResult(), "date");

        $actions = ["link-cow","link-app","button-cow","button-app"];
        $resultActions = [];

        foreach ($actions as $action) {
            $queryAction = $this->createQueryBuilder("UA")
                ->select("COUNT(UA.actions) as count, DATE(UA.date) as date")
                ->andWhere("UA.actions = :actions")
                ->setParameter("actions", $action)
                ->andWhere("UA.date >= :date")
                ->setParameter("date", date("Y-m-d 00:00:00", strtotime("-1 month")))
                ->groupBy("date")
                ->getQuery()
                ->getArrayResult();

            $resultActions[$action] = array_combine(array_column($queryAction, "date"),array_column($queryAction, "count"));
        }

        return [
            'dates' => $dates,
            'actions' => $resultActions
        ];
    }

}

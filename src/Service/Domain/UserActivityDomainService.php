<?php

namespace App\Service\Domain;

use App\DTO\Query\UserActivityQueryDTO;
use App\DTO\Service\EntitiesPackDTO;
use App\Entity\UserActivity;
use App\Service\Entity\UserActivityEntityServiceInterface;
use App\Utils\PaginationUtil;

class UserActivityDomainService implements UserActivityDomainServiceInterface
{

    private UserActivityEntityServiceInterface $userActivityEntity;

    /**
     * @param UserActivityEntityServiceInterface $userActivityEntity
     */
    public function __construct(UserActivityEntityServiceInterface $userActivityEntity)
    {

        $this->userActivityEntity = $userActivityEntity;
    }

    public function create(UserActivity $userActivity): void
    {
        $this->userActivityEntity->create($userActivity);
    }

    public function query(UserActivityQueryDTO $queryDTO): EntitiesPackDTO
    {
        $res = $this->userActivityEntity->query($queryDTO);

        return (new EntitiesPackDTO())
            ->setEntities($res->getResult())
            ->setCount($res->getCount())
            ->setPagination(
                PaginationUtil::makePaginationData($res->getCount(), $queryDTO->getPage(), $queryDTO->getPerPage())
            );
    }

    public function getDataForReport(): array
    {
        return $this->userActivityEntity->getDataForReport();
    }
}
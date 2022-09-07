<?php

namespace App\Service\Entity;

use App\DTO\Query\UserActivityQueryDTO;
use App\DTO\QueryResultDTO;
use App\Entity\UserActivity;
use App\Repository\UserActivityRepository;

class UserActivityEntityService implements UserActivityEntityServiceInterface
{
    private UserActivityRepository $userActivityRepository;

    /**
     * @param UserActivityRepository $userActivityRepository
     */
    public function __construct(UserActivityRepository $userActivityRepository)
    {
        $this->userActivityRepository = $userActivityRepository;
    }

    public function create(UserActivity $userActivity): void
    {
        $this->userActivityRepository->add($userActivity, true);
    }

    public function query(UserActivityQueryDTO $queryDTO): QueryResultDTO
    {
        return $this->userActivityRepository->query($queryDTO);
    }

    public function getDataForReport(): array
    {
       return $this->userActivityRepository->getDataForReport();
    }
}
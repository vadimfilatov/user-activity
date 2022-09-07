<?php

namespace App\Service\Entity;

use App\DTO\Query\UserActivityQueryDTO;
use App\DTO\QueryResultDTO;
use App\Entity\UserActivity;

interface UserActivityEntityServiceInterface
{
    /**
     * @param UserActivity $userActivity
     * @return void
     */
    public function create(UserActivity $userActivity): void;

    /**
     * @param UserActivityQueryDTO $queryDTO
     * @return QueryResultDTO
     */
    public function query(UserActivityQueryDTO $queryDTO): QueryResultDTO;

    /**
     * @return array
     */
    public function getDataForReport(): array;
}
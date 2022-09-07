<?php

namespace App\Service\Domain;

use App\DTO\Query\UserActivityQueryDTO;
use App\DTO\QueryResultDTO;
use App\DTO\Service\EntitiesPackDTO;
use App\Entity\UserActivity;

interface UserActivityDomainServiceInterface
{
    /**
     * @param UserActivity $userActivity
     * @return void
     */
    public function create(UserActivity $userActivity): void;

    /**
     * @param UserActivityQueryDTO $queryDTO
     * @return EntitiesPackDTO
     */
    public function query(UserActivityQueryDTO $queryDTO): EntitiesPackDTO;

    /**
     * @return array
     */
    public function getDataForReport(): array;
}
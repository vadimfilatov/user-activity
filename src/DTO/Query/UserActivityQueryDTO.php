<?php

namespace App\DTO\Query;

use App\DTO\ArrayTransformableDTOInterface;

class UserActivityQueryDTO implements QueryDTOInterface
{

    /**
     * @var array|null
     */
    private ?array $userIds;

    /**
     * @var array|null
     */
    private ?array $actions;

    /**
     * @var string|null
     */
    private ?string $dateFrom;

    /**
     * @var string|null
     */
    private ?string $dateTo;

    /**
     * @var int
     */
    private int $page = 1;

    /**
     * @var int
     */
    private int $perPage = 10;

    /**
     * @var string|null
     */
    private ?string $orderBy;

    /**
     * @var string|null
     */
    private ?string $orderDir;

    /**
     * @var string|null
     */
    private ?string $groupBy;

    /**
     * @param array $data
     * @return UserActivityQueryDTO
     */
    public static function fromArray(array $data): ArrayTransformableDTOInterface
    {
        return (new self)
            ->setUserIds($data['userIds'] ?? null)
            ->setActions($data['actions'] ?? null)
            ->setDateFrom(isset($data['date_from']) ? date("Y-m-d", strtotime($data['date_from'])) . " 00:00:00" : null)
            ->setDateTo(isset($data['date_to']) ? date("Y-m-d", strtotime($data['date_to'])) . " 23:59:59" : null)
            ->setPage($data['p'] ?? 1)
            ->setPerPage($data['pp'] ?? 10)
            ->setOrderBy($data['orderBy'] ?? null)
            ->setOrderDir($data['orderDir'] ?? null)
            ->setGroupBy($data['groupBy'] ?? null);
    }

    public function toArray(): array
    {
        $data = [];

        if($this->getUserIds()) {
            $data['userIds'] = $this->getUserIds();
        }

        if($this->getActions()) {
            $data['actions'] = $this->getActions();
        }

        if($this->getDateFrom()) {
            $data['date_from'] = $this->getDateFrom();
        }

        if($this->getDateTo()) {
            $data['date_to'] = $this->getDateTo();
        }

        return $data;
    }

    /**
     * @return array|null
     */
    public function getUserIds(): ?array
    {
        return $this->userIds;
    }

    /**
     * @param array|null $userId
     * @return UserActivityQueryDTO
     */
    public function setUserIds(?array $userIds): UserActivityQueryDTO
    {
        $this->userIds = $userIds;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getActions(): ?array
    {
        return $this->actions;
    }

    /**
     * @param array|null $actions
     * @return UserActivityQueryDTO
     */
    public function setActions(?array $actions): UserActivityQueryDTO
    {
        $this->actions = $actions;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateFrom(): ?string
    {
        return $this->dateFrom;
    }

    /**
     * @param string|null $dateFrom
     */
    public function setDateFrom(?string $dateFrom): UserActivityQueryDTO
    {
        $this->dateFrom = $dateFrom;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateTo(): ?string
    {
        return $this->dateTo;
    }

    /**
     * @param string|null $dateTo
     * @return UserActivityQueryDTO
     */
    public function setDateTo(?string $dateTo): UserActivityQueryDTO
    {
        $this->dateTo = $dateTo;
        return $this;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param int $page
     * @return UserActivityQueryDTO
     */
    public function setPage(int $page): UserActivityQueryDTO
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @return int
     */
    public function getPerPage(): int
    {
        return $this->perPage;
    }

    /**
     * @param int $perPage
     * @return UserActivityQueryDTO
     */
    public function setPerPage(int $perPage): UserActivityQueryDTO
    {
        $this->perPage = $perPage;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getOrderBy(): ?string
    {
        return $this->orderBy;
    }

    /**
     * @param string|null $orderBy
     * @return UserActivityQueryDTO
     */
    public function setOrderBy(?string $orderBy): UserActivityQueryDTO
    {
        $this->orderBy = $orderBy;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getOrderDir(): ?string
    {
        return $this->orderDir;
    }

    /**
     * @param string|null $orderDir
     * @return UserActivityQueryDTO
     */
    public function setOrderDir(?string $orderDir): UserActivityQueryDTO
    {
        $this->orderDir = $orderDir;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGroupBy(): ?string
    {
        return $this->groupBy;
    }

    /**
     * @param string|null $groupBy
     * @return UserActivityQueryDTO
     */
    public function setGroupBy(?string $groupBy): UserActivityQueryDTO
    {
        $this->groupBy = $groupBy;
        return $this;
    }

}
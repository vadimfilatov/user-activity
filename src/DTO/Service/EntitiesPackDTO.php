<?php


namespace App\DTO\Service;


use App\DTO\PaginationDTO;
use ArrayAccess;

class EntitiesPackDTO
{

    /**
     * @var iterable|ArrayAccess|array
     */
    private $entities;

    /**
     * @var int
     */
    private $count;

    /**
     * @var PaginationDTO
     */
    private $pagination;

    /**
     * @param array|ArrayAccess|iterable $entities
     * @return EntitiesPackDTO
     */
    public function setEntities($entities)
    {
        $this->entities = $entities;
        return $this;
    }

    /**
     * @return array|ArrayAccess|iterable
     */
    public function getEntities()
    {
        return $this->entities;
    }

    /**
     * @param int $count
     * @return EntitiesPackDTO
     */
    public function setCount(int $count): EntitiesPackDTO
    {
        $this->count = $count;
        return $this;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @param PaginationDTO $pagination
     * @return EntitiesPackDTO
     */
    public function setPagination(PaginationDTO $pagination): EntitiesPackDTO
    {
        $this->pagination = $pagination;
        return $this;
    }

    /**
     * @return PaginationDTO
     */
    public function getPagination(): PaginationDTO
    {
        return $this->pagination;
    }

}
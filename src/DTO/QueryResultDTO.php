<?php

namespace App\DTO;

class QueryResultDTO
{
    /**
     * @var array|null
     */
    private ?array $result;
    /**
     * @var int
     */
    private int $count;

    /**
     * @param int $count
     * @return QueryResultDTO
     */
    public function setCount(int $count): QueryResultDTO
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
     * @return array|null
     */
    public function getResult(): ?array
    {
        return $this->result;
    }

    /**
     * @param array|null $result
     * @return QueryResultDTO
     */
    public function setResult(?array $result): QueryResultDTO
    {
        $this->result = $result;
        return $this;
    }

}
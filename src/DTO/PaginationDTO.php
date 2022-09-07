<?php


namespace App\DTO;

class PaginationDTO
{

    /**
     * @var array
     */
    private array $pages;

    /**
     * @var int
     */
    private int $maxPage;

    /**
     * @var int
     */
    private int $nextPage;

    /**
     * @var int
     */
    private int $prevPage;

    /**
     * @var int
     */
    private int $page;

    /**
     * @param array $pages
     * @return PaginationDTO
     */
    public function setPages(array $pages): PaginationDTO
    {
        $this->pages = $pages;
        return $this;
    }

    /**
     * @return array
     */
    public function getPages(): array
    {
        return $this->pages;
    }

    /**
     * @param int $maxPage
     * @return PaginationDTO
     */
    public function setMaxPage(int $maxPage): PaginationDTO
    {
        $this->maxPage = $maxPage;
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxPage(): int
    {
        return $this->maxPage;
    }

    /**
     * @param int $nextPage
     * @return PaginationDTO
     */
    public function setNextPage(int $nextPage): PaginationDTO
    {
        $this->nextPage = $nextPage;
        return $this;
    }

    /**
     * @return int
     */
    public function getNextPage(): int
    {
        return $this->nextPage;
    }

    /**
     * @param int $prevPage
     * @return PaginationDTO
     */
    public function setPrevPage(int $prevPage): PaginationDTO
    {
        $this->prevPage = $prevPage;
        return $this;
    }

    /**
     * @return int
     */
    public function getPrevPage(): int
    {
        return $this->prevPage;
    }

    /**
     * @param int $page
     * @return PaginationDTO
     */
    public function setPage(int $page): PaginationDTO
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }
}
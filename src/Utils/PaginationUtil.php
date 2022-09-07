<?php

namespace App\Utils;

use App\DTO\PaginationDTO;

class PaginationUtil
{

    /**
     * @param int $maxCount
     * @param int $page
     * @param int $perPage
     * @return PaginationDTO
     */
    public static function makePaginationData(int $maxCount, int $page = 1, int $perPage = 10): PaginationDTO
    {

        $maxPage = $perPage > 0 ? ceil($maxCount / $perPage) : 0;
        $maxPage = $maxPage > 1 ? $maxPage : 1;

        $pagesArr = [];

        if ($maxPage > 4) {

            $pagesArr = [
                ($page === 1 ? 1 : ($page < ($maxPage - 2) ? $page - 1 : $maxPage - 4)),
                ($page < ($maxPage - 2) ? ($page === 1 ? 2 : $page) : $maxPage - 3),
                ($page < ($maxPage - 2) ? ($page === 1 ? 3 : $page + 1) : $maxPage - 2),
                ($page < ($maxPage - 3) ? "..." : $maxPage - 1),
                $maxPage
            ];

        } else {

            for ($i = 1; $i <= $maxPage; $i++) {
                $pagesArr[] = $i;
            }

        }

        return (new PaginationDTO)
            ->setPages($pagesArr)
            ->setPage($page <= $maxPage ? $page : 1)
            ->setMaxPage($maxPage)
            ->setNextPage($page < $maxPage ? $page + 1 : $maxPage)
            ->setPrevPage($page > 1 ? $page - 1 : 1);

    }

}
<?php


namespace App\DTO;

/**
 * Represents dto can be created from
 * array and returns transformed data
 * in array.
 *
 * Interface ArrayTransformableDTOInterface
 * @package DTO
 */
interface ArrayTransformableDTOInterface
{

    /**
     * Create form array.
     *
     * @param array $data
     * @return ArrayTransformableDTOInterface
     */
    public static function fromArray(array $data): ArrayTransformableDTOInterface;

    /**
     * Transform to array.
     *
     * @return array
     */
    public function toArray(): array;


}
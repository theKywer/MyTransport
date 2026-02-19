<?php

namespace App\Interfaces;

interface RepositoryInterface
{
    /**
     * Запрос к БД.
     *
     * @param array $data
     * @return void
     */
    public static function query(array $data);
}

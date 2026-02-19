<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

/**
 * Интерфейс для сервисов по бизнес логике
 */
interface ServiceInterface 
{
    /**
     * Создание экземпляра сущности
     *
     * @return void
     */
    public function create(array $data);

    /**
     * Обновление экземпляра сущности
     *
     * @return void
     */
    public function update(array $data);

    /**
     * Получение экземпляра сущности
     *
     * @return void
     */
    public function get(array $data);

    /**
     * Удаление экземпляра сущности
     *
     * @return void
     */
    public function delete(int $id);
}

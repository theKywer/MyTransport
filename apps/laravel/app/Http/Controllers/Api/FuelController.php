<?php

namespace App\Http\Controllers\Api;

use stdClass;
use App\Http\Requests\Fuel\Get;
use App\Http\Requests\Fuel\Create;
use App\Http\Requests\Fuel\Delete;
use App\Http\Requests\Fuel\Update;
use App\Services\Event\FuelService;
use App\Http\Controllers\Api\EntityController;

class FuelController extends EntityController
{
    public function __construct(
        protected FuelService $service
    ) {}
    
    /**
     * @inheritDoc
     */
    protected function service(): FuelService
    {
        return $this->service;
    }

    /**
     * @inheritDoc
     */
    protected function formRequestForCreate(): string
    {
        return Create::class;
    }

    /**
     * @inheritDoc
     */
    protected function formRequestForUpdate(): string
    {
        return Update::class;
    }

    /**
     * @inheritDoc
     */
    protected function formRequestForGet(): string
    {
        return Get::class;
    }

    /**
     * @inheritDoc
     */
    protected function formRequestForDelete(): string
    {
        return Delete::class;
    }

    protected function messages(): stdClass
    {
        $messages = new stdClass();
        $messages->created = 'Заправка сохранена';
        $messages->updated = 'Заправка обновлена';
        $messages->get = 'Заправки транспорта';
        $messages->delete = 'Заправка удалена';

        return $messages;
    }
}

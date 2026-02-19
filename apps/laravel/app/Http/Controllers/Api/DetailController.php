<?php

namespace App\Http\Controllers\Api;

use stdClass;
use App\Http\Requests\Detail\Create;
use App\Http\Requests\Detail\Delete;
use App\Http\Requests\Detail\Get;
use App\Http\Requests\Detail\Update;
use App\Services\Event\DetailService;
use App\Http\Controllers\Api\EntityController;

class DetailController extends EntityController
{
    public function __construct(
        protected DetailService $service
    ) {}

    /**
     * @inheritDoc
     */
    protected function service(): DetailService
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

    /**
     * @inheritDoc
     */
    protected function messages(): stdClass
    {
        $messages = new stdClass();
        $messages->created = 'Деталь из списка событий создана';
        $messages->updated = 'Деталь из списка событий обновлена';
        $messages->get = 'Описание одной детали события';
        $messages->getAll = 'Описание всех деталей события';

        return $messages;
    }
}

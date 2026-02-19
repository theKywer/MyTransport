<?php

namespace App\Http\Controllers\Api;

use stdClass;
use App\Http\Requests\Resource\Create;
use App\Http\Requests\Resource\Delete;
use App\Http\Requests\Resource\Get;
use App\Http\Requests\Resource\Update;
use App\Services\Event\ResourceService;
use App\Http\Controllers\Api\EntityController;

class ResourceController extends EntityController
{
    public function __construct(
        protected ResourceService $service
    ) {}

    /**
     * @inheritDoc
     */
    protected function service(): ResourceService
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
        $messages->created = 'Запчасть из списка событий создана';
        $messages->updated = 'Запчасть из списка событий обновлена';
        $messages->get = 'Описание одной запчасти события';
        $messages->getAll = 'Описание всех запчастей события';

        return $messages;
    }
}

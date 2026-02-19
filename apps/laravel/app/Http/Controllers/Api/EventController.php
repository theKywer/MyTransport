<?php

namespace App\Http\Controllers\Api;

use stdClass;
use Illuminate\Http\Request;
use App\Http\Requests\Event\Get;
use App\Http\Requests\Event\Create;
use App\Http\Requests\Event\Delete;
use App\Http\Requests\Event\Update;
use App\Http\Controllers\Controller;
use App\Services\Event\EventService;
use App\Http\Requests\EventCreateRequest;
use App\Http\Controllers\Api\EntityController;

class EventController extends EntityController
{
    public function __construct(
        protected EventService $service
    ) {}

    /**
     * @inheritDoc
     */
    protected function service(): EventService
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
        $messages->created = 'Событие создано';
        $messages->updated = 'Событие обновлено';
        $messages->get = 'Описание одного события';

        return $messages;
    }
}

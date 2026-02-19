<?php

namespace App\Http\Controllers\Api;

use stdClass;
use App\Http\Requests\Transport\Get;
use App\Http\Requests\Transport\Create;
use App\Http\Requests\Transport\Delete;
use App\Http\Requests\Transport\Update;
use App\Services\Transport\TransportService;
use App\Http\Controllers\Api\EntityController;

class TransportController extends EntityController
{
    public function __construct(
        protected TransportService $service
    ) {}
    
    /**
     * @inheritDoc
     */
    protected function service(): TransportService
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
        $messages->created = 'Транспорт создан';
        $messages->updated = 'Транспорт обновлен';
        $messages->get = 'Описание транспорта';
        $messages->delete = 'Транспорт удален';

        return $messages;
    }
}

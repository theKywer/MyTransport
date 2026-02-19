<?php

namespace App\Services\Event;

use App\Repository\Event\Create;
use App\Repository\Event\Update;
use App\Repository\Event\Get;
use App\Repository\Event\Delete;
use App\Interfaces\ServiceInterface;
use Illuminate\Support\Facades\Validator;

class EventService implements ServiceInterface
{
    /**
     * @inheritDoc
     */
    public function create(array $data)
    {
        return Create::query($data);
    }

    /**
     * @inheritDoc
     */
    public function update(array $data)
    {
        return Update::query($data);
    }

    /**
     * @inheritDoc
     */
    public function get(array $data)
    {
        return Get::query($data);
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id)
    {
        $data = ['id' => $id];
        Validator::make($data, ['id' => 'required|integer|exists:event,id'])->validate();
        $event = Delete::query($data);

        return $event;
    }
}

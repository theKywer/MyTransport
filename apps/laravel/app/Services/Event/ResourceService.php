<?php

namespace App\Services\Event;

use Illuminate\Http\Request;
use App\Repository\Resource\Get;
use App\Repository\Resource\Create;
use App\Repository\Resource\Delete;
use App\Repository\Resource\Update;
use App\Interfaces\ServiceInterface;
use Illuminate\Support\Facades\Validator;

class ResourceService implements ServiceInterface
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
    public function delete(array $data, int $id)
    {
        $data = ['id' => $id];
        Validator::make($data, ['id' => 'required|integer|exists:event_resources,id'])->validate();
        $resource = Delete::query($data);
    }

}

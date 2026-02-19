<?php

namespace App\Services\Event;

use App\Models\Event\Event;
use App\Models\Event\Detail;
use Illuminate\Http\Request;
use App\Repository\Detail\Create;
use App\Repository\Detail\Get;
use App\Repository\Detail\Delete;
use App\Repository\Detail\Update;
use App\Interfaces\ServiceInterface;
use Illuminate\Support\Facades\Validator;

class DetailService implements ServiceInterface
{
    public function create(array $data)
    {
        return Create::query($data);
    }

    public function update(array $data)
    {
        return Update::query($data);
    }

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
        Validator::make($data, ['id' => 'required|integer|exists:event_details,id'])->validate();
        $detail = Delete::query($data);

        return $detail;
    }

}

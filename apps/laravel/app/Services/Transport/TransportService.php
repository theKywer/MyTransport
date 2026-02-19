<?php

namespace App\Services\Transport;

use App\Models\Transport\Transport;
use App\Interfaces\ServiceInterface;
use App\Repository\Transport\Create;
use App\Repository\Transport\Delete;
use App\Repository\Transport\Get;
use App\Repository\Transport\Update;
use Illuminate\Support\Facades\Validator;

class TransportService implements ServiceInterface
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

    public function delete(int $id)
    {
        $data = ['id' => $id];
        Validator::make($data, ['id' => 'required|integer|exists:transport,id'])->validate();
        Delete::query($data);
    }

}

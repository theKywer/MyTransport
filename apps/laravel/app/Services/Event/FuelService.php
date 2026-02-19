<?php

namespace App\Services\Event;

use App\Repository\Fuel\Get;
use App\Repository\Fuel\Create;
use App\Repository\Fuel\Delete;
use App\Repository\Fuel\Update;
use App\Interfaces\ServiceInterface;
use Illuminate\Support\Facades\Validator;

class FuelService implements ServiceInterface
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
        Validator::make($data, ['id' => 'required|integer|exists:fuel,id'])->validate();
        $fuel = Delete::query($data);

        return $fuel;
    }

}

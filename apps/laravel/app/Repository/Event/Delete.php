<?php

namespace App\Repository\Event;

use App\Models\Event\Event;
use App\Interfaces\RepositoryInterface;

class Delete implements RepositoryInterface
{
    public static function query(array $data)
    {
        $event = Event::findOrFail($data['id']);
        $event->delete();
    }
}

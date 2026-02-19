<?php

namespace Tests\Event;

use Tests\TestCase;
use App\Models\User;
use App\Enum\EventType;
use App\Models\Event\Event;
use App\Models\Transport\Transport;
use Database\Factories\EventFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTest extends TestCase 
{
    use RefreshDatabase;



    public function test_user_can_create_event(): void
    {
        $user = User::factory()->create();
        $transport = Transport::factory()->create(['user_id' => $user->id]);

        $event = EventFactory::new()
            ->for($transport)
            ->withDetailsAndResources(2, 2)
            ->make();

        // dd($event->toArray());
        dd($event->details->toArray());

        // $data = $event->toArray();

        // $data['details'] = $event->details->map(function($detail) {
            // return array_merge(
                // $detail->toArray(),
                // ['resources' => $detail->resources->map->toArray()->all()]
            // );
        // })->all();

        // dd($data);
    }

}

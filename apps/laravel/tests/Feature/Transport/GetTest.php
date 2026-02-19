<?php

namespace Tests\Feature\Transport;

use Tests\TestCase;
use App\Models\User;
use App\Models\Transport\Transport;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GetTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_application_returns_a_successful_response(): void
    {
        $user = User::factory()->create();

        $transport = Transport::factory()->count(3)->create(['user_id' => $user->id]);

        $response = $this
            ->actingAs($user, 'sanctum')
            ->json('GET', '/api/transport');

        $response->assertSuccessful();

        $response->assertJson(fn (AssertableJson $json) => $json
            ->where('message', 'Описание транспорта')
            ->has('data', 3)
            ->has(
                'data.0',
                fn ($json) => $json
                    ->where('id', $transport->first()->id)
                    ->where('user_id', $user->id)
                    ->where('type_id', $transport->first()->type_id->value)
                    ->where('name', $transport->first()->name)
                    ->where('vin', $transport->first()->vin)
                    ->where('year', $transport->first()->year)
                    ->where('brand', $transport->first()->brand)
                    ->where('model', $transport->first()->model)
                    ->where('mileage', $transport->first()->mileage)
                    ->where('average_consumption', $transport->first()->average_consumption)
                    ->where('type_label', $transport->first()->type_label)
                    ->whereType('created_at', 'string')
                    ->whereType('updated_at', 'string')
                    ->etc()
            )
            ->etc()
        );
    }

    public function test_user_can_retrieve_single_transport_by_id(): void
    {
        $user = User::factory()->create();
        $transport = Transport::factory()->create(['user_id' => $user->id]);

        $response = $this
            ->actingAs($user, 'sanctum')
            ->json('GET', '/api/transport', ['id' => $transport->id]);

        $response->assertSuccessful();

        $response->assertJson(fn (AssertableJson $json) => $json
            ->where('message', 'Описание транспорта')
            ->has('data', 1)
            ->has('data.0', fn ($json) => $json
                    ->where('id', $transport->id)
                    ->where('user_id', $user->id)
                    ->where('type_id', $transport->type_id->value)
                    ->where('name', $transport->name)
                    ->where('vin', $transport->vin)
                    ->where('year', $transport->year)
                    ->where('brand', $transport->brand)
                    ->where('model', $transport->model)
                    ->where('mileage', $transport->mileage)
                    ->where('average_consumption', $transport->average_consumption)
                    ->where('type_label', $transport->type_label)
                    ->whereType('created_at', 'string')
                    ->whereType('updated_at', 'string')
            )
        );
    }

    public function test_user_cannot_access_other_users_transport(): void
    {
        $otherUser = User::factory()->create();
        $privateTransport = Transport::factory()->create(['user_id' => $otherUser->id]);

        $user = User::factory()->create();

        $response = $this
            ->actingAs($user, 'sanctum')
            ->json('GET', '/api/transport', ['id' => $privateTransport->id]);

        // Должно быть 404 или 403, в зависимости от реализации
        $response->assertStatus(404); // если просто не найдено
        // Или: $response->assertForbidden();
    }

}

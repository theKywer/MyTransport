<?php

namespace Tests\Feature\Transport;

use Tests\TestCase;
use App\Models\User;
use App\Enum\TransportType;
use App\Models\Transport\Transport;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Пользователь может обновить транспорт
     */
    public function test_user_can_update_transport(): void
    {
        $user = User::factory()->create();

        $transport = Transport::factory()->create([
            'user_id' => $user->id,
            'name' => 'Старое имя'
        ]);

        $updateData = [
            'id' => $transport->id,
            'type_id' => TransportType::CAR->value,
            'name' => 'Новое имя',
            'vin' => '1HGBH41JXMN109186',
            'year' => 2020,
            'brand' => 'Toyota',
            'model' => 'Camry',
            'mileage' => 45000,
            'average_consumption' => 8.5,
        ];

        $response = $this
            ->actingAs($user, 'sanctum')
            ->putJson('/api/transport', $updateData);

        $response->assertOk();

        // Проверяем ответ
        $response->assertJson(fn (AssertableJson $json) => $json
            ->where('message', 'Транспорт обновлен')
            ->has('data', fn ($json) => $json
                ->where('id', $transport->id)
                ->where('user_id', $user->id)
                ->where('type_id', $updateData['type_id'])
                ->where('name', $updateData['name'])
                ->where('vin', $updateData['vin'])
                ->where('year', $updateData['year'])
                ->where('brand', $updateData['brand'])
                ->where('model', $updateData['model'])
                ->where('mileage', $updateData['mileage'])
                ->where('average_consumption', $updateData['average_consumption'])
                ->etc()
            )
        );

        // Проверяем, что запись в БД
        $this->assertDatabaseHas('transport', [
            'user_id' => $user->id,
            'name' => $updateData['name'],
        ]);
    }

    /**
     * Валидация: обязательные поля
     */
    public function test_validation_requires_fields(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user, 'sanctum')
            ->putJson('/api/transport', []);

        $response->assertUnprocessable();

        $response->assertJsonValidationErrors([
            'type_id',
            'name',
            'vin',
            'year',
            'brand',
            'model',
            'mileage'
        ]);
    }

    /**
     * Валидация: уникальность name и vin
     */
    public function test_name_and_vin_must_be_unique(): void
    {
        $user = User::factory()->create();

        // Создаём транспорт
        $transport1 = Transport::factory()->create(['user_id' => $user->id]);
        $transport2 = Transport::factory()->create(['user_id' => $user->id]);

        // Пробуем обновить transport2 с тем же name от transport1
        $response = $this
            ->actingAs($user, 'sanctum')
            ->putJson('/api/transport', [
                'id' => $transport2->id,
                'type_id' => TransportType::CAR->value,
                'name' => $transport1->name,
                'vin' => 'ABC123XYZ789',
                'year' => 2020,
                'brand' => 'Test',
                'model' => 'Model',
                'mileage' => 1000,
            ]);

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['name']);

        // Пробуем с тем же vin
        $response = $this
            ->actingAs($user, 'sanctum')
            ->postJson('/api/transport', [
                'id' => $transport2->id,
                'type_id' => TransportType::CAR->value,
                'name' => 'Другая машина',
                'vin' => $transport1->vin,
                'year' => 2020,
                'brand' => 'Test',
                'model' => 'Model',
                'mileage' => 1000,
            ]);

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['vin']);
    }

    /**
     * Валидация: type_id должен быть допустимым
     */
    public function test_type_id_must_be_valid_enum_value(): void
    {
        $user = User::factory()->create();
        $transport = Transport::factory()->create(['user_id' => $user->id]);

        $response = $this
            ->actingAs($user, 'sanctum')
            ->putJson('/api/transport', [
                'id' => $transport->id,
                'type_id' => 999, // несуществующий
                'name' => 'Ошибка',
                'vin' => 'ERROR123',
                'year' => 2000,
                'brand' => 'Test',
                'model' => 'Model',
                'mileage' => 1000,
            ]);

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['type_id']);
    }

    /**
     * Пользователь не может обновить транспорт без авторизации
     */
    public function test_unauthenticated_user_cannot_create_transport(): void
    {
        $user = User::factory()->create();
        $transport = Transport::factory()->create(['user_id' => $user->id]);

        $response = $this->postJson('/api/transport', [
            'id' => $transport->id,
            'type_id' => TransportType::CAR->value,
            'name' => 'Без доступа',
            'vin' => 'NOAUTH123',
            'year' => 2020,
            'brand' => 'Test',
            'model' => 'Model',
            'mileage' => 5000,
        ]);

        $response->assertUnauthorized();
    }
}

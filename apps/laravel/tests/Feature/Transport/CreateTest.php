<?php

namespace Tests\Feature\Transport;

use Tests\TestCase;
use App\Models\User;
use App\Enum\TransportType;
use App\Models\Transport\Transport;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Пользователь может создать транспорт
     */
    public function test_user_can_create_transport(): void
    {
        $user = User::factory()->create();

        $data = [
            'type_id' => TransportType::CAR->value,
            'name' => 'Моя машина',
            'vin' => '1HGBH41JXMN109186',
            'year' => 2020,
            'brand' => 'Toyota',
            'model' => 'Camry',
            'mileage' => 45000,
            'average_consumption' => 8.5,
        ];

        $response = $this
            ->actingAs($user, 'sanctum')
            ->postJson('/api/transport', $data);

        $response->assertCreated();

        // Проверяем ответ
        $response->assertJson(fn (AssertableJson $json) => $json
            ->where('message', 'Транспорт создан')
            ->has('data', fn ($json) => $json
                ->where('id', 1)
                ->where('user_id', $user->id)
                ->where('type_id', $data['type_id'])
                ->where('name', $data['name'])
                ->where('vin', $data['vin'])
                ->where('year', $data['year'])
                ->where('brand', $data['brand'])
                ->where('model', $data['model'])
                ->where('mileage', $data['mileage'])
                ->where('average_consumption', $data['average_consumption'])
                ->whereType('created_at', 'string')
                ->whereType('updated_at', 'string')
                ->etc() // разрешаем другие поля
            )
        );

        // Проверяем, что запись в БД
        $this->assertDatabaseHas('transport', [
            'user_id' => $user->id,
            'name' => $data['name'],
            'vin' => $data['vin']
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
            ->postJson('/api/transport', []);

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
        $transport = Transport::factory()->create(['user_id' => $user->id]);

        // Пробуем создать с тем же name
        $response = $this
            ->actingAs($user, 'sanctum')
            ->postJson('/api/transport', [
                'type_id' => TransportType::CAR->value,
                'name' => $transport->name,
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
                'type_id' => TransportType::CAR->value,
                'name' => 'Другая машина',
                'vin' => $transport->vin,
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

        $response = $this
            ->actingAs($user, 'sanctum')
            ->postJson('/api/transport', [
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
     * Пользователь не может создать транспорт без авторизации
     */
    public function test_unauthenticated_user_cannot_create_transport(): void
    {
        $response = $this->postJson('/api/transport', [
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

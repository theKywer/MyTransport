<?php

namespace Tests\Feature\Transport;

use Tests\TestCase;
use App\Models\User;
use App\Models\Transport\Transport;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_delete_transport(): void
    {
        $user = User::factory()->create();

        $transport = Transport::factory()->create(['user_id' => $user->id]);

        $response = $this
            ->actingAs($user, 'sanctum')
            ->deleteJson('/api/transport/' . $transport->id);

        $response->assertNoContent();

        $this->assertDatabaseMissing('transport', [
            'id' => $transport->id,
        ]);
    }

    public function test_user_cant_delete_transport_other_user(): void
    {
        $otherUser = User::factory()->create();
        $transportOtherUser = Transport::factory()->create(['user_id' => $otherUser->id]);
        $user = User::factory()->create();
        $response = $this
            ->actingAs($user, 'sanctum')
            ->deleteJson('/api/transport/' . $transportOtherUser->id);
        
        $response->assertNotFound();
    }

    public function test_id_not_transmitted(): void
    {
        $user = User::factory()->create();
        $response = $this
            ->actingAs($user, 'sanctum')
            ->deleteJson('/api/transport');

        $response->assertClientError();
    }
}

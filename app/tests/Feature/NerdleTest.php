<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

use App\Models\User;
use App\Models\NerdleEntry;

class NerdleTest extends TestCase
{
    use RefreshDatabase;

    public function test_submit_nerdle_returns_successful_response_for_auth_user() {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/submitnerdle');
        $response->assertStatus(200);
    }

    public function test_submit_nerdle_redirects_for_guest_user() {
        $response = $this->get('/submitnerdle');
        $response->assertStatus(302);
    }

    public function test_nerdle_entry_can_be_submitted() {
        $user = User::factory()->create();
        $this->actingAs($user)->post('/submitnerdle', ['attempts' => 3, 'submit' => 'submit']);
        $this->assertDatabaseHas('nerdle', ['user_id' => $user->id, 'attempts' => 3, 'date' => date('Y-m-d')]);
    }

    public function test_nerdle_submission_can_be_cancelled() {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/submitnerdle', ['cancel' => 'cancel']);
        $response->assertRedirect('/');
    }

    public function test_user_relationship_to_nerdle_entry() {
        $user = User::factory()->create();
        $nerdleEntry = NerdleEntry::factory()->create(['user_id' => $user->id, 'attempts' => 2, 'date' => '2022-03-31']);
        $this->assertInstanceOf(User::class, $nerdleEntry->user);
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

use App\Models\User;
use App\Models\WordleEntry;

class WordleTest extends TestCase
{
    use RefreshDatabase;

    public function test_submit_wordle_returns_successful_response_for_auth_user() {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/submitwordle');
        $response->assertStatus(200);
    }

    public function test_submit_wordle_redirects_for_guest_user() {
        $response = $this->get('/submitwordle');
        $response->assertStatus(302);
    }

    public function test_wordle_entry_can_be_submitted() {
        $user = User::factory()->create();
        $this->actingAs($user)->post('/submitwordle', ['attempts' => 5, 'submit' => 'submit']);
        $this->assertDatabaseHas('wordle', ['user_id' => $user->id, 'attempts' => 5, 'date' => date('Y-m-d')]);
    }

    public function test_wordle_submission_can_be_cancelled() {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/submitwordle', ['cancel' => 'cancel']);
        $response->assertRedirect('/');
    }

    public function test_user_relationship_to_wordle_entry() {
        $user = User::factory()->create();
        $wordleEntry = WordleEntry::factory()->create(['user_id' => $user->id, 'attempts' => 4, 'date' => '2022-03-31']);
        $this->assertInstanceOf(User::class, $wordleEntry->user);
    }
}

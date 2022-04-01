<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

use App\Models\User;

class AppTest extends TestCase
{
    use RefreshDatabase;

    public function test_app_page_returns_successful_response()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_user_can_signup() {
        $user = User::factory()->make();
        $response = $this->post('/signup', $user->only(['name', 'email', 'password']));
        $this->assertDatabaseHas('users', $user->only(['name', 'email']));
        $response->assertSessionHasNoErrors();
        $this->assertAuthenticated();
    }

    public function test_incorrect_credentials_return_login_error() {
        $user = User::factory()->make();
        $response = $this->post('/login', $user->only(['email', 'password']));
        $response->assertRedirect('/');
        $response->assertSessionHasErrors(['email' => 'The provided credentials do not match our records.'], null, 'login');
        $this->assertGuest();
    }

    public function test_user_can_login() {
        $user = User::factory()->create(
            ['password' => Hash::make($password = 'password')]
        );
        $response = $this->post('/login', ['email' => $user->email, 'password' => $password]);
        $response->assertRedirect('/');
        $response->assertSessionHasNoErrors();
        $this->assertAuthenticated();
    }

    public function test_user_can_logout() {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/logout');
        $response->assertRedirect('/');
        $response->assertSessionHasNoErrors();
        $this->assertGuest();
    }

    public function test_submission_abilities_set_for_auth_user() {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/');
        $this->assertEquals(isset(Auth::user()->canSubmitWordle), true);
        $this->assertEquals(isset(Auth::user()->canSubmitNerdle), true);
    }
}

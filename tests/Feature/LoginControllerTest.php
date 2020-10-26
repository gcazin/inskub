<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * On peut accéder au formulaire d'inscription
     */
    public function test_can_view_login_form(): void
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200);
    }

    /**
     * On est redirigé si on est connecté
     */
    public function test_cant_view_login_form_if_user_is_logged(): void
    {
        $user = factory(User::class)->make();

        $response = $this->be($user)->get(route('login'));

        $response->assertStatus(302);
    }

    /**
     * Un utilisateur peut se connecter
     *
     * @return void
     */
    public function test_can_login(): void
    {
        $user = factory(User::class)->create([
            'password' => Hash::make($password = Str::random(10))
        ]);

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => $password,
        ]);

        $this->actingAs($user);

        $response
            ->assertRedirect(route('index'))
            ->assertStatus(302);
    }

    /**
     * Un utilisateur peut se connecter
     *
     * @return void
     */
    public function test_cant_login_with_wrong_credentials(): void
    {
        $user = factory(User::class)->create([
            'password' => Hash::make(Str::random(10))
        ]);

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response
            ->assertSessionHasErrors('email');
    }
}

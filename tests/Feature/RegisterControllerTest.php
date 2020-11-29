<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_can_view_register_form(): void
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function it_cant_view_register_form_if_user_is_logged(): void
    {
        $user = User::factory()->make();

        $response = $this->be($user)->get(route('register'));

        $response->assertStatus(302);
    }

    /**
     * Un utilisateur peut s'enregister
     *
     * @test
     *
     * @return void
     */
    public function it_can_create_account(): void
    {
        $user = User::factory()->make();

        $response = $this->post(route('register'), [
            'role_name' => 'person',
            'last_name' => $user->last_name,
            'first_name' => $user->first_name,
            'email' => $user->email,
            'password' => $user->password,
            'password_confirmation' => $user->password,
        ]);

        $response
            ->assertRedirect(route('index'))
            ->assertStatus(302);
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_password_should_be_identical(): void
    {
        $user = User::factory()->make();

        $response = $this->post(route('register'), [
            'role_name' => 'person',
            'last_name' => $user->last_name,
            'first_name' => $user->first_name,
            'email' => $user->email,
            'password' => $user->password,
            'password_confirmation' => $user->password . '123',
        ]);

        $response
            ->assertSessionHasErrors(['password' => 'Le champ de confirmation password ne correspond pas.'])
            ->assertStatus(302);
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_must_department_exists(): void
    {
        $user = User::factory()->make();

        $response = $this->post(route('register'), [
            'role_name' => 'intermediate',
            'last_name' => $user->last_name,
            'first_name' => $user->first_name,
            'email' => $user->email,
            'password' => $user->password,
            'password_confirmation' => $user->password,
            'department_id' => 9000,
            'siret_number' => 12345678911111
        ]);

        $response
            ->assertSessionHasErrors('department_id')
            ->assertStatus(302);
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_must_siret_number_has_exactly_14_digits(): void
    {
        $user = User::factory()->make();

        $response = $this->post(route('register'), [
            'role_name' => 'intermediate',
            'last_name' => $user->last_name,
            'first_name' => $user->first_name,
            'email' => $user->email,
            'password' => $user->password,
            'password_confirmation' => $user->password,
            'department_id' => 1,
            'siret_number' => 1234
        ]);

        $response
            ->assertSessionHasErrors('siret_number')
            ->assertStatus(302);
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_should_fill_department_and_company_in_role_expert(): void
    {
        $user = User::factory()->make();

        $response = $this->post(route('register'), [
            'role_name' => 'expert',
            'last_name' => $user->last_name,
            'first_name' => $user->first_name,
            'email' => $user->email,
            'password' => $user->password,
            'password_confirmation' => $user->password,
            'company_id' => 1,
            'department_id' => 1,
        ]);

        $response
            ->assertSessionDoesntHaveErrors()
            ->assertRedirect(route('index'))
            ->assertStatus(302);
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_should_fill_department_and_fill_blank_company_in_role_expert(): void
    {
        $user = User::factory()->make();

        $response = $this->post(route('register'), [
            'role_name' => 'expert',
            'last_name' => $user->last_name,
            'first_name' => $user->first_name,
            'email' => $user->email,
            'password' => $user->password,
            'password_confirmation' => $user->password,
            'department_id' => 1,
        ]);

        $response
            ->assertSessionDoesntHaveErrors()
            ->assertRedirect(route('index'))
            ->assertStatus(302);
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_can_fill_blank_department_and_company_in_other_role_than_expert(): void
    {
        $user = User::factory()->make();

        $response = $this->post(route('register'), [
            'role_name' => 'person',
            'last_name' => $user->last_name,
            'first_name' => $user->first_name,
            'email' => $user->email,
            'password' => $user->password,
            'password_confirmation' => $user->password,
        ]);

        $response
            ->assertSessionDoesntHaveErrors()
            ->assertRedirect(route('index'))
            ->assertStatus(302);
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_should_fill_siret_number_in_intermediate_role(): void
    {
        $user = User::factory()->make();

        $response = $this->post(route('register'), [
            'role_name' => 'intermediate',
            'last_name' => $user->last_name,
            'first_name' => $user->first_name,
            'email' => $user->email,
            'password' => $user->password,
            'password_confirmation' => $user->password,
        ]);

        $response
            ->assertSessionHasErrors('siret_number');
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_cant_register_in_super_admin(): void
    {
        $user = User::factory()->make();

        $response = $this->post(route('register'), [
            'role_name' => 'super-admin',
            'last_name' => $user->last_name,
            'first_name' => $user->first_name,
            'email' => $user->email,
            'password' => $user->password,
            'password_confirmation' => $user->password,
        ]);

        $response
            ->assertSessionHasErrors('role_name')
            ->assertStatus(302);
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_cant_register_in_admin(): void
    {
        $user = User::factory()->make();

        $response = $this->post(route('register'), [
            'role_name' => 'admin',
            'last_name' => $user->last_name,
            'first_name' => $user->first_name,
            'email' => $user->email,
            'password' => $user->password,
            'password_confirmation' => $user->password,
        ]);

        $response
            ->assertSessionHasErrors('role_name')
            ->assertStatus(302);
    }
}

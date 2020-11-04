<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->app->make(PermissionRegistrar::class)->registerPermissions();
    }

    /**
     * On peut accéder au formulaire d'inscription
     */
    public function test_can_view_register_form(): void
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200);
    }

    /**
     * On est redirigé si on est connecté
     */
    public function test_cant_view_register_form_if_user_is_logged(): void
    {
        $user = factory(User::class)->make();

        $response = $this->be($user)->get(route('register'));

        $response->assertStatus(302);
    }

    /**
     * Un utilisateur peut s'enregister
     *
     * @return void
     */
    public function test_can_create_account(): void
    {
        $role = Role::make(['name' => 'intermediate']);

        $user = factory(User::class)->make();
        $user->assignRole($role);

        $response = $this->post(route('register'), [
            'role_name' => $user->role_name,
            'last_name' => $user->last_name,
            'first_name' => $user->first_name,
            'email' => $user->email,
            'password' => $user->password,
            'password_confirmation' => $user->password,
            'company_id' => 1,
            'department' => 1,
        ]);

        $response
            ->assertRedirect('/')
            ->assertStatus(302);
    }

    /**
     * Un utilisateur peut s'enregister
     *
     * @test
     *
     * @return void
     */
    public function it_should_fill_department_and_company_in_role_intermediate(): void
    {
        $user = factory(User::class)->make();

        $response = $this->post(route('register'), [
            'role_name' => 'intermediate',
            'last_name' => $user->last_name,
            'first_name' => $user->first_name,
            'email' => $user->email,
            'password' => $user->password,
            'password_confirmation' => $user->password,
            'company_id' => 1,
            'department_id' => 1,
        ]);

        $response
            ->assertRedirect('/')
            ->assertStatus(302);
    }

    /**
     * Un utilisateur peut s'enregister
     *
     * @test
     *
     * @return void
     */
    public function it_can_fill_blank_department_and_company_in_other_role_than_intermediate(): void
    {
        factory(Role::class)->make(['name' => 'person']);
        $user = factory(User::class)->make();

        $response = $this->post(route('register'), [
            'role_name' => 'person',
            'last_name' => $user->last_name,
            'first_name' => $user->first_name,
            'email' => $user->email,
            'password' => $user->password,
            'password_confirmation' => $user->password,
        ]);

        $response
            ->assertRedirect('/')
            ->assertStatus(302);
    }

    /**
     * Les mots de passe doivent être identiques
     *
     * @return void
     */
    public function test_password_should_be_identical(): void
    {
        $user = factory(User::class)->make();

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
     * On ne peut pas s'inscrire en tant que super-admin
     *
     * @return void
     */
    public function test_cant_register_in_super_admin(): void
    {
        $user = factory(User::class)->make();

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
     * On ne peut pas s'inscrire en tant que admin
     *
     * @return void
     */
    public function test_cant_register_in_admin(): void
    {
        $user = factory(User::class)->make();

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

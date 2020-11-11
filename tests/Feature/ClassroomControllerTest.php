<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Tests\TestCase;

class ClassroomControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public Role $testSchoolRole;

    public function setUp(): void
    {
        parent::setUp();

        $this->testSchoolRole = Role::create(['name' => 'school']);

        $this->app->make(PermissionRegistrar::class)->registerPermissions();
    }

    /**
     * @test
     */
    public function it_can_create_classroom()
    {
        $user = User::factory()->create();
        $user->assignRole($this->testSchoolRole);

        $this->be($user)->post(route('school.classroom.store'), [
            'name' => 'Classe',
            'description' => $this->faker->realText(50),
        ]);

        $this->assertDatabaseHas('classrooms', [
            'name' => 'Classe',
        ]);
    }

}

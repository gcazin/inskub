<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class ClassroomControllerTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_create_classroom()
    {
        $user = User::factory()->create();
        $user->assignRole('school');

        $this->be($user)->post(route('school.classroom.store'), [
            'name' => 'Classe',
            'description' => $this->faker->realText(50),
        ]);

        $this->assertDatabaseHas('classrooms', [
            'name' => 'Classe',
        ]);
    }
}

<?php

namespace Tests\Feature;

use App\Jobs\SendEmailProfessor;
use App\Models\Classroom;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Str;
use Tests\TestCase;

class ProfessorControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function it_can_create_professor()
    {
        $user = User::factory()->create();
        $user->assignRole('school');

        $classrooms = Classroom::factory()->count(5)->create()->map(function($classroom) {
            return $classroom->id;
        });

        $this->be($user)->post(route('school.professor.store'), [
            'last_name' => $this->faker->lastName,
            'first_name' => $this->faker->firstName,
            'email' => $this->faker->email,
            'classrooms' => $classrooms
        ]);

        $password = Str::random(8);

        Bus::fake();
        SendEmailProfessor::dispatch(User::find(1), auth()->user(), $password);
        Bus::assertDispatched(SendEmailProfessor::class);

        $this
            ->assertDatabaseHas('classroom_professor', [
                'classroom_id' => $classrooms->first(),
                'professor_id' => 1
            ])
            ->assertDatabaseCount('classroom_professor', 5);
    }
}

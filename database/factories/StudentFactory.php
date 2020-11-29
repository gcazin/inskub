<?php

namespace Database\Factories;

use App\Models\Classroom;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $schoolId = User::role('school')->get()->random()->id;
        return [
            'student_id' => User::factory()->create()->assignRole('person'),
            'classroom_id' => Classroom::all()->where('school_id', $schoolId)->random()->id,
            'school_id' => $schoolId
        ];
    }
}

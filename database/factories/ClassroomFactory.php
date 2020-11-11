<?php

namespace Database\Factories;

use App\Models\Classroom;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClassroomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Classroom::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->numberBetween(3,6) . 'eme ' . strtoupper($this->faker->randomLetter),
            'description' => $this->faker->optional()->text,
            'school_id' => User::role('school')->get()->random()->id
        ];
    }
}

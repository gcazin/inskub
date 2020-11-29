<?php

namespace Database\Factories;

use App\Models\Formation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FormationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Formation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->realText(),
            'location' => $this->faker->address,
            'entry_price' => $this->faker->numberBetween(1000,2000),
            'level' => 'Bac +' . $this->faker->numberBetween(1,10),
            'user_id' => User::all()->random()->id
        ];
    }
}


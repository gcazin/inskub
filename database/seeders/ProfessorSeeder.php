<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Professor;
use Illuminate\Database\Seeder;

class ProfessorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Professor::factory()->count(5)->create()->each(function($professor) {
           $professor->classrooms()->attach(Classroom::all()->random()->id);
       });
    }
}

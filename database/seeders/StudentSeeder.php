<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::factory()
            ->count(10)
            ->create()
            ->each(function($student) {
                $student->classroom()->associate(Classroom::all()->random());
            });
    }
}

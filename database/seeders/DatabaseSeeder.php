<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            UserProfileDataSeeder::class,
            PostSeeder::class,
            ReplyPostSeeder::class,
            JobsTypeSeeder::class,
            JobSeeder::class,
            FormationSeeder::class,
            ProjectSeeder::class,
            TodoSeeder::class,
            ClassroomSeeder::class,
            ProfessorSeeder::class,
            StudentSeeder::class,
        ]);
    }
}

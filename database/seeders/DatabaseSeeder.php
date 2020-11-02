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
        $this->call(UserSeeder::class);
        $this->call(UserProfileDataSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(ReplyPostSeeder::class);
        $this->call(JobsTypeSeeder::class);
        $this->call(JobSeeder::class);
        $this->call(FormationSeeder::class);
        $this->call(ProjectSeeder::class);
        $this->call(TodoSeeder::class);
        //$this->call(ProjectUserSeeder::class);
    }
}

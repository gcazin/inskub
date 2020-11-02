<?php

namespace Database\Seeders;

use App\Models\ProjectUser;
use Illuminate\Database\Seeder;

class ProjectUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ProjectUser::class, 40)->create()->each(function ($project) {
            $project->save();
        });
    }
}

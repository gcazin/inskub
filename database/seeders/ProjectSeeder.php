<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectUser;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Project::class, 5)->create()->each(function ($project) {
            $project->participants()->save(factory(ProjectUser::class)->create());
        });
    }
}

<?php

use App\Todo;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $project = factory(\App\Project::class)->create();


        factory(Todo::class, 40)->create()->each(function ($todo) use($project) {
            $todo->assigned()->save(factory(\App\User::class)->create([
                'project_id' => $project->id
            ]));
        });
    }
}

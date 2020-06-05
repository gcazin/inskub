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
        factory(Todo::class, 40)->create()->each(function ($todo) {
            $todo->assigned()->save(factory(\App\User::class)->make());
            $todo->project()->save(factory(\App\User::class)->make());
        });
    }
}

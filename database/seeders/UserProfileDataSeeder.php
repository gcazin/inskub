<?php

namespace Database\Seeders;

use App\Models\UserExperience;
use App\Models\UserFormation;
use Illuminate\Database\Seeder;

class UserProfileDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(UserFormation::class, 30)->create()->each(function ($userFormation) {
            $userFormation->save();
        });

        factory(UserExperience::class, 30)->create()->each(function ($userExperience) {
            $userExperience->save();
        });
    }
}

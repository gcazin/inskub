<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(User::class)->create([
            'first_name' => 'Super',
            'last_name' => 'admin',
            'password' => Hash::make('superadmin'),
            'email' => 'superadmin@inskub.fr',
        ]);
        $user->assignRole('super-admin');

        factory(User::class, 2)->create([
            'first_name' => 'Admin',
            'last_name' => 'admin',
        ])->each(function($user) {
            $user->assignRole('admin');
        });

        if(env('APP_ENV') === "local") {
            foreach(Role::all() as $role) {
                factory(User::class, 3)->create([
                    'last_name' => $role->name,
                    'department_id' => $role->name === 'intermediate' ? Department::all()->random()->id : null,
                    'company_id' => $role->name === 'intermediate' ? Role::all()->random()->id : null
                ])->each(function($user) use ($role) {
                    $user->assignRole($role);
                });

                factory(User::class)->create([
                    'email' => trans($role->name).'@'.trans($role->name).'.fr',
                    'password' => Hash::make('secret1234'),
                    'last_name' => $role->name,
                    'department_id' => $role->name === 'intermediate' ? Department::all()->random()->id : null,
                    'company_id' => $role->name === 'intermediate' ? Role::all()->random()->id : null
                ])->each(function($user) use ($role) {
                    $user->assignRole($role);
                });
            }
        }
    }
}

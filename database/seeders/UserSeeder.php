<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        /**
         * Super-Admin
         */
        Permission::create(['name' => 'admin.*']);
        $super_admin = Role::create(['name' => 'super-admin']);

        /**
         * Admins
         */
        Permission::create(['name' => '*.create,update,view']);
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo('*.create,update,view');

        /**
         * Écoles
         */
        Permission::create(['name' => 'professor.create,update,view']);
        Permission::create(['name' => 'classroom.create,update,view']);
        $school = Role::create(['name' => 'school']);
        $school->givePermissionTo('professor.create,update,view');
        $school->givePermissionTo('classroom.create,update,view');


        $company = Role::create(['name' => 'company']);
        $intermediate = Role::create(['name' => 'intermediate']);
        $student = Role::create(['name' => 'student']);
        $person = Role::create(['name' => 'person']);
        $other = Role::create(['name' => 'other']);

        $roles = collect([$person, $intermediate, $school, $company, $student, $other]);

        $user = factory(User::class)->create([
            'first_name' => 'Super',
            'last_name' => 'admin',
            'password' => Hash::make('superadmin'),
            'email' => 'superadmin@inskub.fr',
        ]);
        $user->assignRole($super_admin);

        factory(User::class, 2)->create([
            'first_name' => 'Admin',
            'last_name' => 'admin',
        ])->each(function($user) use ($admin) {
            $user->assignRole($admin);
        });

        if(env('APP_ENV') === "local") {
            foreach($roles as $role) {
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

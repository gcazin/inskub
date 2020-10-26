<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'create professor']);
        Permission::create(['name' => 'create classroom']);

        $roles = ['super-admin', 'administrateur', 'personne', 'intermédiaire', 'école', 'compagnie', 'étudiant', 'autre'];

        foreach($roles as $role) {
            $access[$role] = Role::create(['name' => $role]);
        }

        $access['école']->givePermissionTo('create professor');
        $access['école']->givePermissionTo('create classroom');
    }
}

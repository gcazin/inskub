<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateRolesAndPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'roles:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
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


        Role::create(['name' => 'company']);
        Role::create(['name' => 'intermediate']);
        Role::create(['name' => 'student']);
        Role::create(['name' => 'person']);
        Role::create(['name' => 'other']);

        $this->info('Les rôles et les permissions ont bien été crées !');
    }
}

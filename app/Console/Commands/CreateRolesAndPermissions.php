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
    protected $signature = 'roles-permissions:create';

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
     * @return int
     */
    public function handle()
    {
        // Rôles et permissions
        Permission::create(['name' => '*.*']);
        Role::create(['name' => 'super-admin']);

        Permission::create(['name' => 'admin.*']);
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo('admin.*');

        Permission::create(['name' => 'professor.*']);
        Permission::create(['name' => 'class.*']);
        Permission::create(['name' => 'classroom.*']);
        $school = Role::create(['name' => 'school']);
        $school->givePermissionTo('professor.*');
        $school->givePermissionTo('class.*');


        Role::create(['name' => 'company']);
        Role::create(['name' => 'intermediate']);
        Role::create(['name' => 'student']);
        Role::create(['name' => 'person']);
        Role::create(['name' => 'other']);

        $this->info('Les rôles et les permissions ont été générés.');

        return 0;
    }
}

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
        Permission::create(['name' => 'professor.*']);
        Permission::create(['name' => 'class.*']);
        Permission::create(['name' => 'classroom.*']);
        Permission::create(['name' => 'admin.*']);
        Permission::create(['name' => 'sinister.*']);
        Permission::create(['name' => 'expert.*']);

        Role::create(['name' => 'super-admin']);

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo('admin.*');

        /**
         * Une école à les droits suivants : * sur les professeurs et classes
         */
        $school = Role::create(['name' => 'school']);
        $school->givePermissionTo('professor.*');
        $school->givePermissionTo('class.*');

        /**
         * Une compagnie à les droits suivants : Voir les experts
         */
        $company = Role::create(['name' => 'company']);
        $company->givePermissionTo('expert.*');

        /**
         * Un expert à les droits suivants : * sur les sinistres
         */
        $expert = Role::create(['name' => 'expert']);
        $expert->givePermissionTo('sinister.*');

        /**
         * Un intermédiaire à les droits suivants : Voir les experts
         */
        $intermediate = Role::create(['name' => 'intermediate']);
        $intermediate->givePermissionTo('expert.*');

        Role::create(['name' => 'person']);
        Role::create(['name' => 'other']);

        $this->info('Les rôles et les permissions ont été générés.');

        return 0;
    }
}

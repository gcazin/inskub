<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRolesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('display_name');
            $table->timestamps();
        });

        $roles = ['admin', 'Personne', 'Intermédiaire', 'École', 'Compagnie', 'Autre'];

        foreach($roles as $role) {
            DB::table('roles')->insert([
                'name' => $role,
                'display_name' => $role
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles_tables');
    }
}

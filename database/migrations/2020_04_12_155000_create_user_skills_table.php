<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_skills', function (Blueprint $table) {
            $table->id();
            $table->string('title');

            $table->timestamps();
        });

        $skills = [
            'Accidents',
            'Corps de véhicules terrestres',
            'Corps de véhicules ferroviaires',
            'Corps de véhicules aériens',
            'Corps de véhicules maritimes, lacustres et fluviaux',
            'Marchandises transportées par voie maritime ',
            'Marchandises transportées par voie terrestres et fluviales',
            'Incendie et éléments naturels',
            'Autres dommages aux biens',
            'Responsabilité civile véhicules terrestres automoteurs',
            'Responsabilité civile véhicules aériens',
            'Responsabilité civile véhicules maritimes, lacustres et fluviaux',
            'Responsabilité civile générale',
            'Protection juridique',
            'Assistance',
            'Assurances liées à des fonds d\'investissement'
        ];

        foreach($skills as $skill) {
            \Illuminate\Support\Facades\DB::table('user_skills')->insert([
                'title' => $skill
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
        Schema::dropIfExists('user_skills');
    }
}

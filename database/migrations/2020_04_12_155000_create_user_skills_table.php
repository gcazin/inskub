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
            'bâtiment', 'construction', 'réparation automobile', 'agriculture', 'transport aérien', 'transport maritime', 'médecine', 'objets d\'art'
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

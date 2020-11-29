<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateReasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reasons', function (Blueprint $table) {
            $table->id();
            $table->string('title');

            $table->timestamps();
        });

        $reasons = [
            'Nudité',
            'Violences',
            'Harcelement',
            'Suicide ou automutilation',
            'Fausse information',
            'Contenu indésirable',
            'Discours haineux',
            'Terrorisme',
        ];

        foreach($reasons as $reason) {
            DB::table('reasons')->insert([
                'title' => $reason
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
        Schema::dropIfExists('reasons');
    }
}

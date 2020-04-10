<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateVisibilityPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visibility_posts', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('description');
            $table->timestamps();
        });

        $visibilities = [
            'Public' => 'Tout le monde pourra voir votre publication',
            'Abonnés' => 'Votre publication ne sera visible que pour vos abonnés',
            'Privée' => 'Votre publication ne sera visible que par vous'];

        /*
         * Tout le monde sur ou en dehors de TomorrowInsurance
         * Vos abonnées sur TomorrowInsurance
         * Moi uniquement
         */
        foreach($visibilities as $type => $description) {
            DB::table('visibility_posts')->insert([
                'type' => $type,
                'description' => $description
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
        Schema::dropIfExists('visibility_posts');
    }
}

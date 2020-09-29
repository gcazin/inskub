<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->float('rating');
            $table->longText('description')->nullable();

            $table->unsignedBigInteger('expert_id');
            $table->unsignedBigInteger('rated_by');

            $table->timestamps();

            $table->foreign('expert_id')->references('id')->on('users');
            $table->foreign('rated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ratings');
    }
}

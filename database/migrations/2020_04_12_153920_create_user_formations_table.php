<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserFormationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_formations', function (Blueprint $table) {
            $table->id();
            $table->string('school');
            $table->string('degree');
            $table->string('study_area');
            $table->year('start_date');
            $table->year('finish_date');
            $table->longText('description')->nullable();
            $table->string('media')->nullable();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_formations');
    }
}

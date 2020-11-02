<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestExpertisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_expertises', function (Blueprint $table) {
            $table->id();
            $table->json('description');
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('expert_id');
            $table->unsignedBigInteger('project_id')->nullable();
            $table->unsignedBigInteger('conversation_id')->nullable();
            $table->string('refuse_reason')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();

            $table->foreign('sender_id')->references('id')->on('users');
            $table->foreign('expert_id')->references('id')->on('users');
            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('conversation_id')->references('id')->on('chat_conversations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_expertise');
    }
}

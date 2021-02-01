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
            $table->foreignId('sender_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('expert_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('project_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('conversation_id')->nullable()->constrained('chat_conversations')->cascadeOnDelete();
            $table->string('further_information')->nullable();
            $table->string('detailed_description')->nullable();
            $table->string('media')->nullable();
            $table->string('refuse_reason')->nullable();
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('request_expertises');
    }
}

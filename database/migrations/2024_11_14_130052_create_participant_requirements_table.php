<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('participant_requirements', function (Blueprint $table) {
            $table->id();
            $table->string('requirement');

            $table->unsignedBigInteger('seminar_id');
            $table->unsignedBigInteger('workshop_id');


            $table->timestamps();
        });

        
        // Schema::table('participant_requirements', function (Blueprint $table) {

        //     $table->foreign('seminar_id')->references('id')->on('seminars')->onDelete('cascade')->onUpdate('cascade');
        //     $table->foreign('workshop_id')->references('id')->on('workshops')->onDelete('cascade')->onUpdate('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participant_requirements');
    }
};
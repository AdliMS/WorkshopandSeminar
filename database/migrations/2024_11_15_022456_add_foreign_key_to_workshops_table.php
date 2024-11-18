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
        Schema::table('workshops', function (Blueprint $table) {
            //
             // foreign keys
             $table->unsignedBigInteger('category_id')->nullable();
             $table->unsignedBigInteger('status_id')->nullable();
             $table->unsignedBigInteger('speaker_id')->nullable();
             $table->foreign('category_id')->references('id')->on('event_categories')->onDelete('cascade')->onUpdate('cascade');
             
             $table->foreign('status_id')->references('id')->on('event_statuses')->onDelete('cascade')->onUpdate('cascade');
             

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('workshops', function (Blueprint $table) {
            //
        });
    }
};

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
        Schema::create('seminars', function (Blueprint $table) {

            // required values
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('description');
            $table->integer('max_participants');
            $table->date('open_until');
            $table->datetime('start_time');
            $table->datetime('end_time');

            // optional values
            $table->string('venue')->nullable();
            $table->string('online_platform')->nullable();
            $table->string('online_link')->nullable();
            $table->string('ticket_price')->nullable();

            $table->timestamps();

        });

       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seminars');
    }

    
};

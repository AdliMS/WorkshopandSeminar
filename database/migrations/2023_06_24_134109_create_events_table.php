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
        Schema::create('events', function (Blueprint $table) {

            // required values
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('slug');
            $table->string('description');
            $table->integer('max_participants');
            $table->integer('current_participants')->default('0');
            $table->date('open_until');
            $table->datetime('start_time');
            $table->datetime('end_time');

            // foreign keys
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('event_categories')->onDelete('cascade')->onUpdate('cascade');
            // $table->unsignedBigInteger('speaker_id')->nullable();

            // optional values
            $table->string('venue')->nullable();
            $table->string('online_platform')->nullable();
            $table->string('online_link')->nullable();
            $table->string('ticket_price')->default('0');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};

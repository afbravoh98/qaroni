<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_descriptions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('eventId')
                ->constrained('events')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('language');
            $table->string('name');
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
        Schema::dropIfExists('event_descriptions');
    }
}

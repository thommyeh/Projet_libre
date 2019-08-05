<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
<<<<<<< Updated upstream
<<<<<<< Updated upstream
            $table->string('event_title',150);
            $table->string('event_start_date',15)->nullable();
            $table->string('event_start_time',15)->nullable();
            $table->string('event_end_date',15)->nullable();
            $table->string('event_end_time',15)->nullable();
            $table->text('event_description')->default('aucune description');
=======
=======
>>>>>>> Stashed changes
            $table->string('event_title', 150);
            $table->string('event_start_date', 15)->nullable();
            $table->string('event_start_time', 15)->nullable();
            $table->string('event_end_date', 15)->nullable();
            $table->string('event_end_time', 15)->nullable();
            $table->text('event_description')->nullable();
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}

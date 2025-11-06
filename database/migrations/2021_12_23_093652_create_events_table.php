<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->String('name');
            $table->String('description');
            $table->Float('price');
            $table->String('logo_url');
            $table->String('thumbnail_url');
            $table->integer('max_tickets');
            $table->String('status');
            $table->String('start_date');
            $table->String('start_time');
            $table->String('end_date');
            $table->String('end_time');
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
        Schema::dropIfExists('events');
    }
}

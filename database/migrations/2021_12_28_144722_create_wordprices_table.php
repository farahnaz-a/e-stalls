<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWordpricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wordprices', function (Blueprint $table) {
          $table->id();
          $table->String('word');
          $table->String('p1');
          $table->String('p2');
          $table->String('p3');
          $table->integer('p1_amount');
          $table->integer('p2_amount');
          $table->integer('p3_amount');
          $table->Float('chance');
          $table->integer('eventID');
          $table->String('release_time');
          $table->String('release_date');
          $table->String('participating_tickets');
          $table->String('correct_tickets');
          $table->String('winning_tickets');
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
        Schema::dropIfExists('wordprices');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auctions', function (Blueprint $table) {
          $table->id();
          $table->string('status');
          $table->String('start_time');
          $table->String('end_time');
          $table->string('image_url');
          $table->string('name');
          $table->string('description');
          $table->string('SN')->default('none');
          $table->float('current_bid', 8, 2);
          $table->float('min_bid', 8, 2);
          $table->float('min_step', 8, 2);
          $table->float('tax', 8, 2);
          $table->integer('vendorID')->default(1);
          $table->integer('eventID')->default(1);
          $table->integer('stock')->default(0);
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
        Schema::dropIfExists('auctions');
    }
}

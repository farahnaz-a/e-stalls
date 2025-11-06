<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Popupprices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      {
          Schema::create('popupprices', function (Blueprint $table) {
            $table->id();
            $table->String('price_name');
            $table->String('contents');
            $table->String('claimed_by');
            $table->Float('chance');
            $table->integer('stock')->default(100);
            $table->integer('eventID');
            $table->timestamps();
          });
      }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('popupprices');
    }
}

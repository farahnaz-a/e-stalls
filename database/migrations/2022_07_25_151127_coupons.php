<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Coupons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('coupons', function (Blueprint $table) {
             $table->id();
             $table->string('image_url')->default("https://freesvg.org/img/1653460522icon-promo.png");
             $table->string('name');
             $table->string('description');
             $table->string('SN')->default('none');
             $table->float('price', 8, 2);
             $table->float('tax', 8, 2);
             $table->integer('vendorID')->default(1);
             $table->integer('max')->default(0);
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
         Schema::dropIfExists('coupons');
     }
}

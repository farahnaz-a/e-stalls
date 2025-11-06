<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->String('contents');
            $table->integer('product_code');
            $table->integer('paid_to')->default(1);
            $table->Float('price');
            $table->integer('paid_by');
            $table->string('first_name');
            $table->string('last_name');
            $table->String('phone_number');
            $table->String('email');
            $table->String('street');
            $table->String('zip');
            $table->String('town');
            $table->String('country');
            $table->string('paid')->default('pending');
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
        Schema::dropIfExists('orders');
    }
}

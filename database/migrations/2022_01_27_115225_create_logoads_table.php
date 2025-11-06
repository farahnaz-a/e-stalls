<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogoadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logoads', function (Blueprint $table) {
            $table->id();
            $table->integer('clicks')->default(0);
            $table->String('redirect_url');
            $table->String('logo_url');
            $table->integer('vendorID');
            $table->integer('eventID');
            $table->boolean('enabled')->default(true);
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
        Schema::dropIfExists('logoads');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Goodiebags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('goodiebags', function (Blueprint $table) {
        $table->id();
        $table->String('contents');
        $table->String('claimed_by')->default("");
        $table->integer('stock')->default(100);
        $table->integer('stallID')->default(1);
        $table->boolean('enabled')->default(1);
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
      Schema::dropIfExists('goodiebags');
  }
}

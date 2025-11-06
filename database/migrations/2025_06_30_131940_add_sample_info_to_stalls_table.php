<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSampleInfoToStallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stalls', function (Blueprint $table) {
            $table->string('sample_contents')->nullable();
            $table->integer('sample_stock')->default(0);
            $table->string('sample_logo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stalls', function (Blueprint $table) {
            $table->dropColumn('sample_contents');
            $table->dropColumn('sample_stock');
            $table->dropColumn('sample_logo');
        });
    }
}

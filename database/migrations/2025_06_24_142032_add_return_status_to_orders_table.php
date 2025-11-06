<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReturnStatusToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('return_status')->default(0)->comment('0 = not requested, 1 = requested, 2 = approved, 3 = rejected');
            $table->integer('cancel_status')->default(0)->comment('0 = not requested, 1 = requested, 2 = approved, 3 = rejected');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('return_status');
            $table->dropColumn('cancel_status');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReminderStatusToEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->integer('alert_15_min_before')->default(0);
            $table->integer('alert_30_min_before')->default(0);
            $table->integer('alert_60_min_before')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('alert_15_min_before');
            $table->dropColumn('alert_30_min_before');
            $table->dropColumn('alert_60_min_before');
        });
    }
}

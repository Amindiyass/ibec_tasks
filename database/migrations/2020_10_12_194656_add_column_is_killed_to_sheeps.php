<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIsKilledToSheeps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sheeps', function (Blueprint $table) {
            $table->tinyInteger('is_killed')->after('yard_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sheeps', function (Blueprint $table) {
            $table->dropColumn('is_killed');
        });
    }
}

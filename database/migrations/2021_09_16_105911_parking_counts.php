<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ParkingCounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parking_counts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('attribute');
            $table->unsignedInteger('count');
            $table->timestamps();
        });

        DB::update("ALTER TABLE parking_counts AUTO_INCREMENT = 1000;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parking_counts');
    }
}

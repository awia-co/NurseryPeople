<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClimateZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('climate_zones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('meta_description')->nullable();
            $table->unsignedBigInteger('low_zone_id');
            $table->unsignedBigInteger('high_zone_id');
            $table->timestamps();

            $table->foreign('low_zone_id')
                ->references('id')->on('zones');
            $table->foreign('high_zone_id')
                ->references('id')->on('zones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('climate_zones');
    }
}

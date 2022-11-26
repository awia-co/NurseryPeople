<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeaturePlantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature_plant', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('plant_id');
            $table->unsignedBigInteger('feature_id');
            $table->timestamps();

            $table->unique(['plant_id', 'feature_id']);

            $table->foreign('plant_id')
                ->references('id')
                ->on('plants')
                ->onDelete('cascade');

            $table->foreign('feature_id')
                ->references('id')->on('features')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feature_plant');
    }
}

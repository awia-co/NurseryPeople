<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('plant_category_id')->nullable();
            $table->unsignedBigInteger('climate_zone_id')->nullable();
            $table->unsignedBigInteger('environment_id')->nullable();
            $table->string('name');
            $table->boolean('is_featured')->default(false);
            $table->string('slug')->unique();
            $table->string('sci_name')->nullable();
            $table->string('com_name')->nullable();
            $table->text('description')->nullable();
            $table->string('height_ft')->nullable();
            $table->string('width_ft')->nullable();
            $table->text('fall_description')->nullable();
            $table->text('flower_description')->nullable();
            $table->text('extra_features')->nullable();
            $table->timestamps();

            $table->foreign('plant_category_id')
                ->references('id')->on('plant_categories')
                ->onDelete('set null');
            $table->foreign('climate_zone_id')
                ->references('id')->on('climate_zones')
                ->onDelete('set null');
            $table->foreign('environment_id')
                ->references('id')->on('environments')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plants');
    }
}

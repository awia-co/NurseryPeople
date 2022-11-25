<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsPublishedColumnToPlantsAndCompaniesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // If the plants table does not have the is_published column, add it.
        if (!Schema::hasColumn('plants', 'is_published')) {
            Schema::table('plants', function (Blueprint $table) {
                $table->boolean('is_published')->default(true);
            });
        }

        // If the companies table does not have the is_published column, add it.
        if (!Schema::hasColumn('companies', 'is_published')) {
            Schema::table('companies', function (Blueprint $table) {
                $table->boolean('is_published')->default(true);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plants', function (Blueprint $table) {
            $table->dropColumn('is_published');
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('is_published');
        });
    }
}

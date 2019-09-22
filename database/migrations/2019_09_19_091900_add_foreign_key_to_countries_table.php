<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('staff_members', function (Blueprint $table) {
            
            $table->foreign('country_id')
                ->references('id')
                ->on(\Config::get('countries.table_name'))
                ->onDelete('cascade');
        });

        Schema::table('cities', function (Blueprint $table) {

            $table->foreign('country_id')
                ->references('id')
                ->on(\Config::get('countries.table_name'))
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
        Schema::table('countries', function (Blueprint $table) {
            //
        });
    }
}

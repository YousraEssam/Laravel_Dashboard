<?php

use Illuminate\Database\Migrations\Migration;

class SetupCountriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        // Creates the users table
        Schema::create(\Config::get('countries.table_name'), function ($table) {
            $table->integer('id')->unsigned()->index();
            $table->string('name', 255)->default('');
            $table->string('capital', 255)->nullable();
            $table->string('full_name', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::drop(\Config::get('countries.table_name'));
    }
}

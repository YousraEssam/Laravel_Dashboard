<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('first_name', 150);
                $table->string('last_name', 150);
                $table->string('email')->unique();
                $table->string('gender')->nullable();

                $table->unsignedInteger('city_id')->nullable();
                $table->unsignedInteger('country_id')->nullable();

                $table->string('phone')->unique();
                $table->string('password');

                $table->softDeletes();
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

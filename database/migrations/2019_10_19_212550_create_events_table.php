<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'events', function (Blueprint $table) {
                $table->increments('id');
                $table->string('main_title', 150);
                $table->string('secondary_title', 150);
                $table->string('content');
                $table->dateTimeTz('start_date');
                $table->dateTimeTz('end_date');
                $table->string('address_address');
                $table->double('address_latitude');
                $table->double('address_longitude');
                $table->boolean('is_published')->default(true);

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
        Schema::dropIfExists('events');
    }
}

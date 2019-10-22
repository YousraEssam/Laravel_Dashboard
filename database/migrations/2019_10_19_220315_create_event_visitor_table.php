<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventVisitorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'event_visitor', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedInteger('event_id');
                $table->unsignedInteger('visitor_id');

                $table->foreign('event_id')
                    ->references('id')
                    ->on('events')
                    ->onDelete('cascade');

                $table->foreign('visitor_id')
                    ->references('id')
                    ->on('visitors')
                    ->onDelete('cascade');

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
        Schema::dropIfExists('event_visitor');
    }
}

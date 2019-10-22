<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelatedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'related', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedInteger('news_id');
                $table->foreign('news_id')
                    ->references('id')
                    ->on('news')
                    ->onDelete('cascade');

                $table->unsignedInteger('related_id');
                $table->foreign('related_id')
                    ->references('id')
                    ->on('news')
                    ->onDelete('cascade');

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
        Schema::dropIfExists('related');
    }
}

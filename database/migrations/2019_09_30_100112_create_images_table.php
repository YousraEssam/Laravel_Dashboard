<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'images', function (Blueprint $table) {
                $table->increments('id');
                $table->string('url');
                $table->integer('imageable_id')->nullable();
                $table->string('imageable_type')->nullable();   
                $table->string('name',150)->nullable();
                $table->string('description',250)->nullable(); 

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
        Schema::dropIfExists('images');
    }
}

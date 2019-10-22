<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'news', function (Blueprint $table) {
                $table->increments('id');
                $table->string('main_title', 150);
                $table->string('secondary_title', 150);
                $table->string('content');
                $table->string('type');
                $table->boolean('is_published')->default(true);
            
                $table->unsignedInteger('author_id');
            
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
        Schema::dropIfExists('news');
    }
}

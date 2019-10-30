<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFolderStaffMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folder_staff_member', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('folder_id');
            $table->unsignedInteger('staff_member_id');

            $table->foreign('folder_id')
                ->references('id')
                ->on('folders')
                ->onDelete('cascade');

            $table->foreign('staff_member_id')
                ->references('id')
                ->on('staff_members')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('folder_staff_member');
    }
}

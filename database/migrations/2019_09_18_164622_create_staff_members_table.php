<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'staff_members', function (Blueprint $table) {
                $table->increments('id');

                $table->unsignedInteger('user_id');
                $table->unsignedInteger('job_id');
                // $table->unsignedInteger('city_id');
                // $table->unsignedInteger('country_id');
                $table->unsignedInteger('role_id');            
                // $table->boolean('is_active')->default(true);

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
        Schema::dropIfExists('staff_members');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Employees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->integer('position_id');
            $table->integer('dept_id');
            $table->integer('branch_id');
            $table->date('birthdate');
            $table->integer('age');
            $table->string('gender');
            $table->date('employed_date');
            $table->string('local_address');
            $table->integer('city_code');
            $table->integer('province_code');
            $table->string('emergency_name');
            $table->string('emergency_contact');
            $table->string('emergency_address');
            $table->string('id_pic');
            $table->string('sign_pic');
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
        Schema::dropIfExists('employees');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Leaves extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('leaves', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('leavetype_id');
            $table->integer('employee_id');
            $table->date('date_start');
            $table->date('date_end');
            $table->string('reason');
            $table->string('file_attachment');
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
        Schema::dropIfExists('leaves');
    }
}

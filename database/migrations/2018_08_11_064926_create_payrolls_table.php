<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->increments('id');
            $table->date('start_day');
            $table->date('end_day');
            $table->date('date');
            $table->decimal('total_hours');
            $table->decimal('gross_pay');
            $table->decimal('deductions');
            $table->decimal('net_pay');
            $table->integer('employee_id');
            $table->string('status');
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
        Schema::dropIfExists('payrolls');
    }
}

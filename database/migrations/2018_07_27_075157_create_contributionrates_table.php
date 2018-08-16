<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContributionratesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contributionrates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contribution_id');
            $table->decimal('rate_to');
            $table->decimal('rate_from');
            $table->decimal('er');
            $table->decimal('ee');
            $table->decimal('total');
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
        Schema::dropIfExists('contributionrates');
    }
}

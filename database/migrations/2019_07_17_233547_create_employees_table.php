<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
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
            $table->string('name');
            $table->string('mobile')->nullable();
            $table->string('nationalId')->nullable();
            $table->integer('salary');
            $table->integer('numDays');
            $table->integer('numHours');
            $table->float('S_perDay')->nullable();//S=>Salary
            $table->float('S_perHour')->nullable();
            $table->string('job');
            $table->integer('balance');
            $table->smallInteger('status');
            $table->smallInteger('qualification');
            $table->string('address')->nullable();
            $table->string('note')->nullable();
            $table->string('avatar')->nullable();
            $table->smallInteger('isactive');
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

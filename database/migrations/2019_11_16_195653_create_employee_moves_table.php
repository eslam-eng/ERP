<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeMovesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('employee_moves', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('empId')->unsigned();
            $table->foreign('empId')->references('id')->on('employees')->onDelete('cascade');
            $table->date('date');
            $table->text('attendanceTime')->nullable();
            $table->text('leaveTime')->nullable();
            $table->float('work_hour')->nullable();
            $table->string('attnote')->nullable();
            $table->string('leavenote')->nullable();
            $table->integer('borrow')->nullable();
            $table->integer('reward')->nullable();
            $table->integer('S_deduct')->nullable();
            $table->longText('absentnote')->nullable();
            $table->longText('note')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_moves');
    }
}

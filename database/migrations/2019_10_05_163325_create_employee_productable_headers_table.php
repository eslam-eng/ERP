<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeProductableHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_productable_headers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('empId')->unsigned();
            $table->foreign('empId')->references('id')->on('employees')->onDelete('cascade');
            $table->string('desc_work');
            $table->float('finaltotal');
            $table->date('date')->default(Carbon\Carbon::now('Africa/Cairo')->format('y-m-d'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_productable_headers');
    }
}

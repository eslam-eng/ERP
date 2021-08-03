<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeProductableDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_productable_details', function (Blueprint $table) {
            $table->integer('billnum')->unsigned();
            $table->foreign('billnum')->references('id')->on('employee_productable_headers')->onDelete('cascade');
            $table->string('product');
            $table->float('qty');
            $table->float('unitprice');
            $table->float('subtotal');
            $table->string('note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_productable_details');
    }
}

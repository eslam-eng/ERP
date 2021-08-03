<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSallcustomerbillDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sallcustomerbill_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('billnum')->unsigned();
            $table->foreign('billnum')->references('id')->on('sallcustomerbills')->onDelete('cascade');
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
        Schema::dropIfExists('sallcustomerbill_details');
    }
}

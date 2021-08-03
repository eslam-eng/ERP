<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatchReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catch_receipts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('name')->unsigned();
            $table->foreign('name')->references('id')->on('suppliers')->onDelete('cascade');
            $table->date('date');
            $table->string('receiver')->nullable();
            $table->string('note')->nullable();
            $table->float('value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catch_receipts');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('responsible');
            $table->string('mobile');
            $table->string('email')->nullable();
            $table->float('balance');
            $table->string('address')->nullable();
            $table->integer('isactive');
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
        Schema::dropIfExists('suppliers');
    }
}

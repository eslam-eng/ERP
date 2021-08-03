<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailyExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_expenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('genralexpense');
            $table->text('maker');
            $table->integer('value');
            $table->longText('note')->nullable();
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
        Schema::dropIfExists('daily_expenses');
    }
}

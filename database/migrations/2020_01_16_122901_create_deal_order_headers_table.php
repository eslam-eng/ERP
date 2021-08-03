<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealOrderHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deal_order_headers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('deal_id')->unsigned();
            $table->foreign('deal_id')->references('id')->on('customer_deal_headers')->onDelete('cascade');
            $table->float('tax')->nullable();
            $table->float('discount')->nullable();
            $table->float('total');
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
        Schema::dropIfExists('deal_order_headers');
    }
}

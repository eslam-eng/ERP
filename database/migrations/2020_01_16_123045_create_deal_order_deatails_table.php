<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealOrderDeatailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deal_order_deatails', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('deal_id')->unsigned();
            $table->foreign('deal_id')->references('id')->on('customer_deal_headers')->onDelete('cascade');
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
        Schema::dropIfExists('deal_order_deatails');
    }
}

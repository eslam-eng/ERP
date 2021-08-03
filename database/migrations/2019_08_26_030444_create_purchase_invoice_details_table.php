<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_invoice_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('billnum')->unsigned();
            $table->foreign('billnum')->references('id')->on('purchase_invoices')->onDelete('cascade');
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
        Schema::dropIfExists('purchase_invoice_details');
    }
}

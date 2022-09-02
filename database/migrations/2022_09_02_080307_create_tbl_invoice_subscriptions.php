<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblInvoiceSubscriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_invoice_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subs_ord_id')->nullable()->constrained('tbl_subscriptions')->onDelete('cascade');
            $table->foreignId('inv_id')->nullable()->constrained('tbl_invoices')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_invoice_subscriptions');
    }
}

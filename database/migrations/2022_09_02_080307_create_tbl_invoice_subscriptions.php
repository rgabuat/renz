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
            $table->string('inv_id');
            $table->foreignId('customer')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('amount_due',12,2);
            $table->string('billing_reason')->nullable();
            $table->string('collection_method')->nullable();
            $table->string('created')->nullable();
            $table->string('due_date')->nullable();
            $table->string('currency')->nullable();
            $table->string('hosted_invoice_url')->nullable();
            $table->string('invoice_pdf')->nullable();
            $table->string('number')->nullable();
            $table->string('status')->nullable();
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

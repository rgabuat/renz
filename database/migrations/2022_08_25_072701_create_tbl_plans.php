<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPlans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_plans', function (Blueprint $table) {
            $table->id();
            $table->string('plan_id');
            $table->string('name');
            $table->integer('amount');
            $table->string('billing_method');
            $table->tinyInteger('interval_count');
            $table->string('currency');
            $table->text('description')->nullable();
            $table->integer('credits');
            $table->string('payment_method');
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('cascade');
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
        Schema::dropIfExists('tbl_plans');
    }
}

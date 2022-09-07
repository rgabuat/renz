<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblSubscriptionRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_subscription_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cus_uid')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('cus_sid');
            $table->foreignId('plan_id')->nullable()->constrained('tbl_plans')->onDelete('cascade')->onUpdate('cascade');
            $table->string('status');
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
        Schema::dropIfExists('tbl_subscription_requests');
    }
}

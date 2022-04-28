<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDomainDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domain_data', function (Blueprint $table) {
            $table->id();
            $table->string('domain');
            $table->string('country');
            $table->string('domain_rating');
            $table->string('traffic');
            $table->string('ref_domain');
            $table->string('token_cost');
            $table->string('remarks');
            $table->string('last_updated');
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
        Schema::dropIfExists('domain_data');
    }
}

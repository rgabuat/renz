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
            $table->string('domain')->nullable();
            $table->string('country')->nullable();
            $table->string('domain_rating')->nullable();
            $table->string('traffic')->nullable();
            $table->string('ref_domain')->nullable();
            $table->string('token_cost')->nullable();
            $table->string('remarks')->nullable();
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

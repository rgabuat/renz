<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDidToTblArticleOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_article_order', function (Blueprint $table) {
            $table->foreignId('domain_id')->nullable()->constrained('domain_data')->onDelete('cascade');
            $table->string('heading')->nullable();
            $table->string('link_url_1')->nullable();
            $table->string('link_url_2')->nullable();
            $table->string('anchor_1')->nullable();
            $table->string('anchor_2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_article_order', function (Blueprint $table) {
            //
        });
    }
}

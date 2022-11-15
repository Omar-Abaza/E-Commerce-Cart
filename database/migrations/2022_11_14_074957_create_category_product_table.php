<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('category_product')){

        Schema::create('category_product', function (Blueprint $table) {
            $table->integer('category_id')->unsigned()->index()->foreign('category_id')->references('id')->on('categories');
            $table->integer('product_id')->unsigned()->index()->foreign('product_id')->references('id')->on('products');
        });
    }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_product');
    }
};

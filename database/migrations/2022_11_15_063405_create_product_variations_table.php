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
        if(!Schema::hasTable('product_variations')){

        Schema::create('product_variations', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->unsigned()->index()->foreign('product_id')->references('id')->on('products');
            $table->string('name');
            $table->integer('price')->nullable();
            $table->integer('order')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('product_variations');
    }
};

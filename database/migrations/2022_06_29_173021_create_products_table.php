<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->string('name')->require();
            $table->text('images')->require();
            $table->string('generic')->require();
            $table->string('body')->require();
            $table->string('company')->nullable();
            $table->integer('sell_price');
            $table->integer('discount_percentage')->nullable();
            $table->integer('category_id');
            $table->json('sku');
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('products');
    }
}

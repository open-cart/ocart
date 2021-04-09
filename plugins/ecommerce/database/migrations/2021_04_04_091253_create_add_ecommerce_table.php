<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddEcommerceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecommerce_currencies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description')->nullable();
            $table->string('title');
            $table->string('symbol', 10);
            $table->tinyInteger('is_prefix_symbol')->unsigned()->default(0);
            $table->tinyInteger('decimals')->unsigned()->default(0);
            $table->integer('order')->default(0)->unsigned();
            $table->tinyInteger('is_default')->default(0);
            $table->double('exchange_rate')->default(1);
            $table->string('thousands_separator', 10)->default(',');
            $table->string('decimal_separator', 10)->default(',');
            $table->timestamps();
        });

        DB::statement('ALTER TABLE `nguyen`.`ecommerce_products` 
MODIFY COLUMN `price` double UNSIGNED NOT NULL AFTER `sku`,
MODIFY COLUMN `price_sell` double UNSIGNED NULL DEFAULT NULL AFTER `price`');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ecommerce_currencies');
    }
}

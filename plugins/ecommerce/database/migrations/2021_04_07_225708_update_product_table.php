<?php

use Illuminate\Database\Migrations\Migration;

class UpdateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `ecommerce_products` 
CHANGE COLUMN `price_sell` `sale_price` double UNSIGNED NULL DEFAULT NULL AFTER `price`,
ADD COLUMN `sale_type` tinyint NOT NULL DEFAULT 0 AFTER `price`,
ADD COLUMN `sale_at` timestamp NULL DEFAULT NULL AFTER `price`,
ADD COLUMN `end_sale_at` timestamp NULL DEFAULT NULL AFTER `sale_at`;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

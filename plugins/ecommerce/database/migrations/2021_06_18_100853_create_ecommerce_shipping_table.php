<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEcommerceShippingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecommerce_stores', function (Blueprint $table) {
            $table->id();
            $table->string('name', 60);
            $table->string('email', 60)->nullable();
            $table->string('phone', 20);
            $table->string('address', 255);
            $table->string('country', 120)->nullable();
            $table->string('state', 120)->nullable();
            $table->string('city', 120)->nullable();
            $table->boolean('is_primary')->default(false)->nullable();
            $table->boolean('is_shipping_location')->default(true)->nullable();
            $table->timestamps();
        });

        Schema::create('ecommerce_shipping', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('country', 120)->nullable();
            $table->timestamps();
        });

        Schema::create('ecommerce_shipping_rules', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->integer('shipping_id')->unsigned();
            $table->enum('type', ['base_on_price', 'base_on_weight'])->default('base_on_price')->nullable();
            $table->integer('currency_id')->unsigned()->nullable();
            $table->decimal('from', 15)->default(0)->nullable();
            $table->decimal('to', 15)->default(0)->nullable();
            $table->decimal('price', 15)->default(0)->nullable();
            $table->timestamps();
        });

//        Schema::create('ecommerce_shipping_rule_items', function (Blueprint $table) {
//            $table->id();
//            $table->integer('shipping_rule_id', false, true);
//            $table->string('country', 120)->nullable();
//            $table->string('state', 120)->nullable();
//            $table->string('city', 120)->nullable();
//            $table->decimal('adjustment_price', 15)->default(0)->nullable();
//            $table->boolean('is_enabled')->default(true);
//            $table->timestamps();
//        });

        Schema::create('ecommerce_shipments', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id', false, true);
            $table->integer('user_id', false, true)->nullable();
            $table->float('weight')->default(0)->nullable();
            $table->string('shipment_id', 120)->nullable();
            $table->string('note', 120)->nullable();
            $table->string('status', 120)->default('pending');
            $table->decimal('cod_amount', 15)->default(0)->nullable();
            $table->string('cod_status', 60)->default('pending');
            $table->string('cross_checking_status', 60)->default('pending');
            $table->decimal('price', 15)->default(0)->nullable();
            $table->integer('store_id', false, true)->nullable();
            $table->timestamps();
        });

        Schema::create('ecommerce_shipment_histories', function (Blueprint $table) {
            $table->id();
            $table->string('action', 120);
            $table->string('description', 255);
            $table->integer('user_id', false, true)->nullable();
            $table->integer('shipment_id', false, true);
            $table->integer('order_id', false, true);
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
        Schema::dropIfExists('ecommerce_stores');
        Schema::dropIfExists('ecommerce_shipping');
        Schema::dropIfExists('ecommerce_shipping_rules');
//        Schema::dropIfExists('ecommerce_shipping_rule_items');
        Schema::dropIfExists('ecommerce_shipments');
        Schema::dropIfExists('ecommerce_shipment_histories');
    }
}

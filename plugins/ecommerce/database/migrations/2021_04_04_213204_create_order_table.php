<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecommerce_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('shipping_option', 60)->nullable();
            $table->string('shipping_method', 60)->default('default');
            $table->string('status', 120)->default('pending');
            $table->decimal('amount', 15);
            $table->integer('currency_id')->unsigned()->nullable();
            $table->decimal('tax_amount')->nullable();
            $table->decimal('shipping_amount')->nullable();
            $table->text('description')->nullable();
            $table->string('coupon_code', 120)->nullable();
            $table->decimal('discount_amount', 15)->nullable();
            $table->decimal('sub_total', 15);
            $table->boolean('is_confirmed')->default(false);
            $table->string('discount_description', 255)->nullable();
            $table->boolean('is_finished')->default(1)->nullable();
            $table->string('token', 120)->nullable();
            $table->integer('payment_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::create('ecommerce_order_product', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id')->unsigned();
            $table->integer('qty');
            $table->decimal('price', 15);
            $table->decimal('tax_amount', 15);
            $table->text('options')->nullable();
            $table->integer('product_id')->unsigned()->nullable();
            $table->string('product_name');
            $table->float('weight')->default(0)->nullable();
            $table->integer('restock_quantity', false, true)->default(0)->nullable();
            $table->timestamps();
        });

        Schema::create('ecommerce_order_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('country', 120)->nullable();
            $table->string('state', 120)->nullable();
            $table->string('city', 120)->nullable();
            $table->string('address');
            $table->integer('order_id')->unsigned();
        });

        Schema::create('ecommerce_customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('avatar', 255)->nullable();
            $table->date('dob')->nullable();
            $table->string('phone', 25)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('ecommerce_customer_password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('ecommerce_customer_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email', 60)->nullable();
            $table->string('phone');
            $table->string('country', 120)->nullable();
            $table->string('state', 120)->nullable();
            $table->string('city', 120)->nullable();
            $table->string('address');
            $table->integer('customer_id')->unsigned();
            $table->tinyInteger('is_default')->default(0)->unsigned();
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
        Schema::dropIfExists('ecommerce_orders');
        Schema::dropIfExists('ecommerce_order_addresses');
        Schema::dropIfExists('ecommerce_order_product');
        Schema::dropIfExists('ecommerce_customer_addresses');
        Schema::dropIfExists('ecommerce_customer_password_resets');
        Schema::dropIfExists('ecommerce_customers');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEcommerceAttributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ecommerce_products', function (Blueprint $table) {
            $table->tinyInteger('is_variation')->default(0);
        });

        Schema::create('ecommerce_attribute_groups', function (Blueprint $table) {
            $table->id();
            $table->string('title', 120);
            $table->string('slug', 120);
            $table->string('display_layout', 191);
            $table->tinyInteger('is_searchable');
            $table->tinyInteger('is_comparable');
            $table->tinyInteger('is_use_in_product_listing');
            $table->string('status', 60);
            $table->integer('order');
            $table->timestamps();
        });

        Schema::create('ecommerce_attributes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attribute_group_id');
            $table->string('title', 120);
            $table->string('slug', 120);
            $table->string('color', 50)->nullable();
            $table->string('image', 500)->nullable();
            $table->tinyInteger('is_default')->default(0);
            $table->integer('order')->default(0);
            $table->string('status', 60)->default(\Ocart\Core\Enums\BaseStatusEnum::PUBLISHED);
            $table->timestamps();
        });

        Schema::create('ecommerce_product_variations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('configurable_product_id');
            $table->tinyInteger('is_default');
        });

        Schema::create('ecommerce_product_variation_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attribute_id');
            $table->unsignedBigInteger('product_id');
        });

        Schema::create('ecommerce_product_with_attribute_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attribute_group_id');
            $table->unsignedBigInteger('product_id');
            $table->tinyInteger('order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ecommerce_products', function (Blueprint $table) {
            $table->dropColumn('is_variation');
        });
        Schema::dropIfExists('ecommerce_attribute_groups');
        Schema::dropIfExists('ecommerce_attributes');
        Schema::dropIfExists('ecommerce_product_variations');
        Schema::dropIfExists('ecommerce_product_variation_items');
        Schema::dropIfExists('ecommerce_product_with_attribute_groups');
    }
}

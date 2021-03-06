<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('name', 255);
            $table->longText('content');
            $table->string('description', 400)->nullable();
            $table->string('slug', 255)->nullable();
            $table->string('slug_md5', 64)->unique();
            $table->string('status', 60)->default('published');
            $table->integer('user_id')->references('id')->on('users');
            $table->tinyInteger('is_featured')->default(0);

            $table->string('sku', 255);
            $table->float('price');
            $table->float('price_sell');

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

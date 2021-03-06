<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Models\User;

class CreateEcommerceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecommerce_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 120);
            $table->string('slug', 255)->nullable();
            $table->string('slug_md5', 64)->unique();
            $table->integer('parent_id')->unsigned()->default(0);
            $table->string('description', 400)->nullable();
            $table->string('status', 60)->default('published');
            $table->integer('author_id');
            $table->string('author_type', 255)->default(addslashes(User::class));
            $table->string('icon', 60)->nullable();
            $table->tinyInteger('order')->default(0);
            $table->tinyInteger('is_featured')->default(0);
            $table->tinyInteger('is_default')->unsigned()->default(0);
            $table->timestamps();
        });

        Schema::create('ecommerce_products', function (Blueprint $table) {
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
            $table->float('price_sell')->nullable();

            $table->timestamps();
        });

        Schema::create('ecommerce_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 120);
            $table->string('slug', 255)->nullable();
            $table->string('slug_md5', 64)->unique();
            $table->integer('author_id');
            $table->string('author_type', 255)->default(addslashes(User::class));
            $table->string('description', 400)->nullable()->default('');
            $table->integer('parent_id')->unsigned()->default(0);
            $table->string('status', 60)->default('published');
            $table->timestamps();
        });

        Schema::create('ecommerce_brands', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 120);
            $table->string('slug', 255)->nullable();
            $table->string('slug_md5', 64)->unique();
            $table->string('website', 255);
            $table->integer('author_id');
            $table->string('author_type', 255)->default(addslashes(User::class));
            $table->string('description', 400)->nullable()->default('');
            $table->integer('parent_id')->unsigned()->default(0);
            $table->string('status', 60)->default('published');
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
        Schema::dropIfExists('ecommerce_categories');
        Schema::dropIfExists('ecommerce_products');
        Schema::dropIfExists('ecommerce_tags');
        Schema::dropIfExists('ecommerce_brands');
    }
}

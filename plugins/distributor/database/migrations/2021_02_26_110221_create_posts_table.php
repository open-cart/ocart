<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 120);
            $table->integer('parent_id')->unsigned()->default(0);
            $table->string('description', 400)->nullable();
            $table->string('status', 60)->default('published');
            $table->integer('author_id');
            $table->string('author_type', 255)->default(addslashes(User::class));
            $table->string('icon', 60)->nullable();
            $table->tinyInteger('order')->default(0);
            $table->tinyInteger('is_featured')->default(0);
            $table->tinyInteger('is_default')->unsigned()->default(0);
            $table->string('slug', 255)->nullable();
            $table->string('slug_md5', 64)->unique();
            $table->timestamps();
        });

        Schema::create('blog_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 120);
            $table->integer('author_id');
            $table->string('author_type', 255)->default(addslashes(User::class));
            $table->string('description', 400)->nullable()->default('');
            $table->integer('parent_id')->unsigned()->default(0);
            $table->string('status', 60)->default('published');
            $table->string('slug', 255)->nullable();
            $table->string('slug_md5', 64)->unique();
            $table->timestamps();
        });

        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('description', 400)->nullable();
            $table->text('content')->nullable();
            $table->string('status', 60)->default('published');
            $table->integer('author_id');
            $table->string('author_type', 255)->default(addslashes(\App\Models\User::class));
            $table->tinyInteger('is_featured')->unsigned()->default(0);
            $table->string('image', 255)->nullable();
            $table->integer('views')->unsigned()->default(0);
            $table->string('format_type', 30)->nullable();
            $table->string('slug', 255)->nullable();
            $table->string('slug_md5', 64)->unique();
            $table->timestamps();
        });

        Schema::create('blog_post_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tag_id')->unsigned()->references('id')->on('blog_tags')->onDelete('cascade');
            $table->integer('post_id')->unsigned()->references('id')->on('blog_posts')->onDelete('cascade');
        });

        Schema::create('blog_post_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned()->references('id')->on('blog_categories')->onDelete('cascade');
            $table->integer('post_id')->unsigned()->references('id')->on('blog_posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('blog_post_tags');
        Schema::dropIfExists('blog_post_categories');
        Schema::dropIfExists('blog_posts');
        Schema::dropIfExists('blog_categories');
        Schema::dropIfExists('blog_tags');
    }
}

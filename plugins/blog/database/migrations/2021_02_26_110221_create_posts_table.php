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
        Schema::create('posts', function (Blueprint $table) {
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}

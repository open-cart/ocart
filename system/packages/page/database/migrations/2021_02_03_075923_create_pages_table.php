<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreatePagesTable.
 */
class CreatePagesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pages', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 120);
            $table->longText('content');
            $table->integer('user_id')->references('id')->on('users');
            $table->string('image', 255)->nullable();
            $table->string('template', 60)->nullable();
            $table->tinyInteger('is_featured')->default(0);
            $table->string('description', 400)->nullable();
            $table->string('slug', 255)->nullable();
            $table->string('slug_md5', 64)->unique();
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
		Schema::drop('pages');
	}
}

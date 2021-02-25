<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateMetaBoxesTable.
 */
class CreateMetaBoxesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('meta_boxes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reference_id')->unsigned()->index();
            $table->string('reference_type', 120);
            $table->string('meta_key', 255);
            $table->text('meta_value')->nullable();
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
		Schema::drop('meta_boxes');
	}
}

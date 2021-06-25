<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string('name', 120);
            $table->string('slug', 120)->unique()->nullable();
            $table->string('status', 60)->default('published');
            $table->timestamps();
        });

        Schema::create('menu_nodes', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->integer('menu_id')->unsigned()->index()->references('id')->on('menus');
            $table->integer('parent_id')->default(0)->unsigned()->index();
            $table->integer('reference_id')->unsigned()->nullable();
            $table->string('reference_type', 255)->nullable();
            $table->string('url', 120)->nullable();
            $table->string('icon_font', 50)->nullable();
            $table->tinyInteger('position')->unsigned()->default(0);
            $table->string('title', 120)->nullable();
            $table->string('css_class', 120)->nullable();
            $table->string('target', 20)->default('_self');
            $table->tinyInteger('has_child')->unsigned()->default(0);
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
        Schema::dropIfExists('menus');
        Schema::dropIfExists('menu_nodes');
    }
}

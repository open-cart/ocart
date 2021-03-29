<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEcommerceEclocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ecommerce_products', function (Blueprint $table) {
            $table->string('district_id')->nullable();
            $table->string('province_id')->nullable();
            $table->string('address')->nullable();
            $table->string('location')->nullable();
            $table->string('acreage')->nullable();
            $table->string('bds_type')->nullable();
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
            $table->dropColumn('district_id');
            $table->dropColumn('province_id');
            $table->dropColumn('address');
            $table->dropColumn('location');
            $table->dropColumn('acreage');
            $table->dropColumn('bds_type');
        });
    }
}

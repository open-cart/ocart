<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('permission.table_names');

        \Ocart\Acl\Models\Role::where('id', '>', 0)->update(['guard_name' => 'admin']);
        \Ocart\Acl\Models\Permission::where('id', '>', 0)->update(['guard_name' => 'admin']);
        DB::table($tableNames['model_has_roles'])
            ->update(['model_type' => \App\Models\Admin::class]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

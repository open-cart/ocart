<?php

use App\Models\Admin;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

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

        if (!Admin::where('email', 'nguyen@gmail.com')->first()) {
            Admin::create([
                'name' => 'Phan Trung Nguyên',
                'email' => 'nguyen@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'), // password
                'remember_token' => Str::random(10),
            ]);
        }
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

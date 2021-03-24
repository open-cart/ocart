<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Ocart\Acl\Models\Role;
use Spatie\Permission\Guard;
use App\Models\User;
use Ocart\Acl\Models\Permission;

class CreatePermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $guard_name = Guard::getDefaultName(User::class);
        /** @var Role $owner */
        $owner = Role::create(['name' => 'owners', 'guard_name' => $guard_name]);
        $members = Role::create(['name' => 'members', 'guard_name' => $guard_name]);

        collect([
            'system.users.index',
            'system.users.create',
            'system.users.update',
            'system.users.destroy',

            'system.roles.index',
            'system.roles.create',
            'system.roles.update',
            'system.roles.destroy',
        ])->map(function ($permission) use ($guard_name) {
            $group = \Ocart\Acl\Models\Group::create(['name' => 'System']);
            Permission::create(['name' => $permission, 'guard_name' => $guard_name, 'group_id' => $group->id]);
        });

        collect([
            'pages.index',
            'pages.create',
            'pages.update',
            'pages.destroy',
        ])->map(function ($permission) use ($guard_name) {
            Permission::create(['name' => $permission, 'guard_name' => $guard_name]);
        });


        collect([
            'media.index',
        ])->map(function ($permission) use ($guard_name) {
            Permission::create(['name' => $permission, 'guard_name' => $guard_name]);
        });

        collect([
            'plugins.index',
        ])->map(function ($permission) use ($guard_name) {
            Permission::create(['name' => $permission, 'guard_name' => $guard_name]);
        });

        collect([
            'themes.index',
            'themes.activate'
        ])->map(function ($permission) use ($guard_name) {
            Permission::create(['name' => $permission, 'guard_name' => $guard_name]);
        });

        collect([
            'blog.posts.index',
            'blog.posts.create',
            'blog.posts.update',
            'blog.posts.destroy',

            'blog.tags.index',
            'blog.tags.create',
            'blog.tags.update',
            'blog.tags.destroy',

            'blog.categories.index',
            'blog.categories.create',
            'blog.categories.update',
            'blog.categories.destroy',
        ])->map(function ($permission) use ($guard_name) {
            Permission::create(['name' => $permission, 'guard_name' => $guard_name]);
        });

        collect([
            'ecommerce.categories.index',
            'ecommerce.categories.create',
            'ecommerce.categories.update',
            'ecommerce.categories.destroy',

            'ecommerce.tags.index',
            'ecommerce.tags.create',
            'ecommerce.tags.update',
            'ecommerce.tags.destroy',

            'ecommerce.brands.index',
            'ecommerce.brands.create',
            'ecommerce.brands.update',
            'ecommerce.brands.destroy',

            'ecommerce.products.index',
            'ecommerce.products.create',
            'ecommerce.products.update',
            'ecommerce.products.destroy',
        ])->map(function ($permission) use ($guard_name) {
            Permission::create(['name' => $permission, 'guard_name' => $guard_name]);
        });



        $owner->syncPermissions(Permission::all()->pluck('id')->toArray());

        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();

        $admin = User::where('id', 1)->first();
        $admin->roles()->detach();

        $roles = Role::all();
        foreach ($roles as $role) {
            $role->permissions()->detach();
        }
        Permission::truncate();
        Role::truncate();

        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
    }
}

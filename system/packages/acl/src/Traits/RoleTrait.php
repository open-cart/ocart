<?php
namespace Ocart\Acl\Traits;

use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Ocart\Acl\Models\Role;
use Spatie\Permission\Traits\HasRoles;

trait RoleTrait
{
    use PermissionTrait;

    /**
     * @return MorphToMany
     */
    public function roles()
    {
        return $this->morphToMany(
            config('packages.acl.permission.models.role'),
            'model',
            config('packages.acl.permission.table_names.model_has_roles'),
            config('packages.acl.permission.column_names.model_morph_key'),
            'role_id'
        );
    }

    /**
     * @return boolean
     */
    public function isSuperUser()
    {
        return $this->id == 1;
    }

    /**
     * @param string $permission
     * @return boolean
     */
    public function hasPermission(string $permission)
    {
        if ($this->isSuperUser()) {
            return true;
        }

        return $this->hasAccess($permission);
    }

    /**
     * @param array $permissions
     * @return bool
     */
    public function hasAnyPermission(array $permissions)
    {
        if ($this->isSuperUser()) {
            return true;
        }

        return $this->hasAnyAccess($permissions);
    }

    /**
     * Remove all current roles and set the given ones.
     *
     * @param  array|Role|string  ...$roles
     *
     * @return $this
     */
    public function syncRoles(...$roles)
    {
        $this->roles()->sync($roles);

        return $this;
    }
}
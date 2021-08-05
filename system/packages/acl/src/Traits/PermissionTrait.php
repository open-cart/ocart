<?php

namespace Ocart\Acl\Traits;

trait PermissionTrait
{
    /**
     * @var array
     */
    protected $preparedPermissions = null;

    /**
     * @param $permissions
     * @return bool
     */
    public function hasAccess($permissions): bool
    {
        if (is_string($permissions)) {
            $permissions = func_get_args();
        }

        $prepared = $this->getPreparedPermissions();

        foreach ($permissions as $permission) {
            if (!$this->checkPermission($prepared, $permission)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param $permissions
     * @return bool
     */
    public function hasAnyAccess($permissions): bool
    {
        if (is_string($permissions)) {
            $permissions = func_get_args();
        }

        $prepared = $this->getPreparedPermissions();

        foreach ($permissions as $permission) {
            if ($this->checkPermission($prepared, $permission)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return array
     */
    protected function getPreparedPermissions(): array
    {
        if (!$this->preparedPermissions) {
            $this->preparedPermissions = $this->createPreparedPermissions();
        }

        return $this->preparedPermissions;
    }

    /**
     * @return array
     */
    protected function createPreparedPermissions()
    {
        $allRoles = $this->roles->pluck('name')->toArray();

        $roles = [];

        foreach ($allRoles as $role) {
            $roles[$role] = true;
        }

        $permissions = $this->roles->pluck('permissions')->collapse()->toArray();

        return array_merge($roles, $permissions);
    }

    /**
     * @param array $prepared
     * @param string $permission
     * @return bool
     */
    protected function checkPermission(array $prepared, string $permission): bool
    {
        if (array_key_exists($permission, $prepared) && $prepared[$permission] === true) {
            return true;
        }

        return false;
    }
}
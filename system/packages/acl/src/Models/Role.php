<?php
namespace Ocart\Acl\Models;

use Ocart\Core\Models\BaseModel;

class Role extends BaseModel
{
    public function getTable()
    {
        return config('packages.acl.permission.table_names.roles', parent::getTable());
    }

    protected $guarded = ['id'];

    protected $casts = [
        'permissions' => 'json'
    ];

    /**
     * Set mutator for the "permissions" attribute.
     *
     * @param array $permissions
     * @return void
     */
    public function setPermissionsAttribute(array $permissions)
    {
        $this->attributes['permissions'] = $permissions ? json_encode($permissions) : '';
    }
}
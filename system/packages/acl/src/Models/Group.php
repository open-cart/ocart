<?php
namespace Ocart\Acl\Models;

use Ocart\Core\Models\BaseModel;

class Group extends BaseModel
{
    protected $table = 'acl_groups';

    protected $fillable = [
        'name',
        'description',
    ];
}
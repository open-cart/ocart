<?php
namespace Ocart\Acl\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'acl_groups';

    protected $fillable = [
        'name',
        'description',
    ];
}
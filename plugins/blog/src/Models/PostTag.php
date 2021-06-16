<?php

namespace Ocart\Blog\Models;

use Ocart\Core\Models\BaseModel;

class PostTag extends BaseModel
{
    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'blog_post_tags';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     * @var string[]
     */
    protected $fillable = [
        'tag_id',
        'post_id',
    ];
}

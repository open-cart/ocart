<?php

namespace Ocart\Page\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageDescription extends Model
{
    use HasFactory;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'blog_description_id';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'blog_page_description';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['page_id', 'lang', 'title', 'keyword', 'description', 'content'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps     = false;
}

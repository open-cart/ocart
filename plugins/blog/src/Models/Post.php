<?php

namespace Ocart\Blog\Models;

use App\Models\User;
use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Ocart\Core\Enums\BaseStatusEnum;
use Ocart\Core\Models\BaseModel;

class Post extends BaseModel
{
    use HasFactory;

    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'blog_posts';

    /**
     * The attributes that are mass assignable.
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'content',
        'status',
        'author_id',
        'author_type',
        'is_featured',
        'image',
        'views',
        'format_type',
        'slug',
        'slug_md5',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'status' => BaseStatusEnum::class,
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'blog_post_categories');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'blog_post_tags', 'post_id', 'tag_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function auth()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    protected static function newFactory()
    {
        return new PostFactory();
    }
}

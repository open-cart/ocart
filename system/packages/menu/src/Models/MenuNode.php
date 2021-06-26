<?php

namespace Ocart\Menu\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Ocart\Core\Enums\BaseStatusEnum;
use Ocart\Core\Models\BaseModel;

class MenuNode extends BaseModel
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menu_nodes';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'menu_id',
        'parent_id',
        'reference_id',
        'reference_type',
        'url',
        'icon_font',
        'position',
        'title',
        'css_class',
        'target',
        'has_child',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'status' => BaseStatusEnum::class,
    ];

    protected static function boot()
    {
        parent::boot();
    }

    /**
     * @return BelongsTo
     */
    public function reference()
    {
        return $this->morphTo();
    }

    /**
     * @param string $value
     * @return string
     */
    public function getUrlAttribute($value)
    {

        if ($value) {
            return apply_filters(MENU_FILTER_NODE_URL, $value);
        }

        if (!$this->reference_type) {
            return $value ? (string)$value : '/';
        }

        if (!$this->reference) {
            return '/';
        }

        return (string)$this->reference->url;
    }
}

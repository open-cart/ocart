<?php

namespace Ocart\Attribute\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Ocart\Core\Enums\BaseStatusEnum;
use Ocart\Core\Models\BaseModel;

class Attribute extends BaseModel
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ecommerce_attributes';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'attribute_group_id',
        'title',
        'slug',
        'color',
        'image',
        'is_default',
        'order',
        'status',
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

    public function attributeGroup()
    {
        return $this->belongsTo(AttributeGroup::class);
    }
}
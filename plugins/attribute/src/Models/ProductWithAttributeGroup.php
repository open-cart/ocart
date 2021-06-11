<?php

namespace Ocart\Attribute\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Ocart\Core\Models\BaseModel;

class ProductWithAttributeGroup extends BaseModel
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ecommerce_product_with_attribute_groups';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'attribute_group_id',
        'product_id',
        'order',
    ];

    protected static function boot()
    {
        parent::boot();
    }

    public function attributeGroup()
    {
        return $this->belongsTo(AttributeGroup::class, 'attribute_group_id', 'id');
    }
}
<?php

namespace Ocart\Attribute\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Ocart\Core\Models\BaseModel;

class ProductVariationItem extends BaseModel
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ecommerce_product_variation_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'attribute_id',
        'product_id',
    ];

    protected static function boot()
    {
        parent::boot();
    }
}
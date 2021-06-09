<?php

namespace Ocart\Attribute\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Ocart\Core\Models\BaseModel;

class ProductVariation extends BaseModel
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ecommerce_product_variations';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'product_id',
        'configurable_product_id',
        'is_default',
    ];

    protected static function boot()
    {
        parent::boot();
    }
}
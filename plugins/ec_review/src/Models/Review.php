<?php

namespace Ocart\EcommerceReview\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Ocart\Core\Enums\BaseStatusEnum;
use Ocart\Core\Models\BaseModel;
use Ocart\Ecommerce\Models\Product;

class Review extends BaseModel
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ecommerce_reviews';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'customer_id',
        'product_id',
        'star',
        'comment',
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

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class);
    }
}
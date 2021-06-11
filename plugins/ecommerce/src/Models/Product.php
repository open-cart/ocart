<?php

namespace Ocart\Ecommerce\Models;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Arr;
use Ocart\Core\Enums\BaseStatusEnum;
use Ocart\Core\Models\BaseModel;

class Product extends BaseModel
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ecommerce_products';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'content',
        'images',
        'slug',
        'slug_md5',
        'status',
        'user_id',
        'brand_id',
        'is_featured',
        'sku',
        'price',
        'sale_price',
        'sale_type',
        'sale_at',
        'end_sale_at'
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
     * @return UrlGenerator|string
     */
    public function getUrlAttribute()
    {
        $prefix = apply_filters(FILTER_SLUG_PREFIX, '');

        return url($prefix ? $prefix . '/' . $this->slug : $this->slug);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'ecommerce_product_categories');
    }

    /**
     * @param string $value
     * @return array
     */
    public function getImagesAttribute($value)
    {
        if (is_array($value)) {
            return $value;
        }
        try {
            if ($value === '[null]') {
                return [];
            }

            $images = json_decode((string)$value, true);

            if (is_array($images)) {
                $images = array_filter($images);
            }

            return $images ?: [];
        } catch (\Exception $exception) {
            return [];
        }
    }

    /**
     * @param string $value
     * @return mixed
     */
    public function getImageAttribute()
    {
        return Arr::first($this->images) ?? null;
    }

    /**
     * Giá đang bán
     */
    public function getSellPriceAttribute()
    {
        if ($this->sale_price) {
            return $this->sale_price;
        }

        return $this->price;
    }

    public function getOriginPriceAttribute()
    {
        return $this->sell_price ?? $this->price ?? 0;
    }
}

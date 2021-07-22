<?php

namespace Ocart\Ecommerce\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Arr;
use Ocart\Attribute\Models\ProductVariation;
use Ocart\Core\Enums\BaseStatusEnum;
use Ocart\Core\Models\BaseModel;
use Ocart\Ecommerce\Facades\EcommerceHelper;

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
        'end_sale_at',
        'tax_id'
    ];

    protected $appends = [
        'image',
        'sell_price',
        'sell_price_with_taxes',
        'price_with_taxes',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'status' => BaseStatusEnum::class,
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['tax'];

    protected static function boot()
    {
        parent::boot();

        self::deleting(function (Product $product) {
            $product->categories()->detach();
            $product->tags()->detach();
        });

        self::updating(function($model) {
            $model->slug_md5 = md5($model->slug);
        });
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'ecommerce_product_tags', 'product_id', 'tag_id');
    }

    /**
     * @return BelongsTo
     */
    public function tax()
    {
        return $this->belongsTo(Tax::class, 'tax_id')->withDefault();
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

    /**
     * Get product sale price including taxes
     * Lấy giá bán sản phẩm bao gồm thuế
     * @return float|int|mixed
     */
    public function getSellPriceWithTaxesAttribute()
    {
        if (!EcommerceHelper::isDisplayProductIncludingTaxes()) {
            return $this->sell_price;
        }

        if (!$this->tax->percentage) {
            return $this->sell_price;
        }

        return $this->sell_price + $this->sell_price * ($this->tax->percentage / 100);
    }

    /**
     * Get product sale price including taxes
     * Lấy giá bán sản phẩm bao gồm thuế
     * @return float|int|mixed
     */
    public function getPriceWithTaxesAttribute()
    {
        if (!EcommerceHelper::isDisplayProductIncludingTaxes()) {
            return $this->price;
        }

        if (!$this->tax->percentage) {
            return $this->price;
        }

        return $this->price + $this->price * ($this->tax->percentage / 100);
    }
}

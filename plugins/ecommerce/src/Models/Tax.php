<?php

namespace Ocart\Ecommerce\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\UrlGenerator;
use Ocart\Core\Enums\BaseStatusEnum;
use Ocart\Core\Models\BaseModel;

class Tax extends BaseModel
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ecommerce_taxes';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'percentage',
        'priority',
        'status'
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
}

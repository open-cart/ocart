<?php

namespace Ocart\Page\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\UrlGenerator;

class Page extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pages';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['image', 'alias', 'status'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps     = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function language()
    {
        return $this->hasOne(PageDescription::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function description()
    {
        return $this->hasMany(PageDescription::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function (Page $page) {
            $page->description()->delete();
        });
    }

    /**
     * @return UrlGenerator|string
     */
    public function getUrlAttribute()
    {
        $prefix = apply_filters('FILTER_SLUG_PREFIX', '');

        return url($prefix ? $prefix . '/' . $this->alias : $this->alias);
    }
}

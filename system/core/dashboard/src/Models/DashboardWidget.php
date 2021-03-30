<?php

namespace Ocart\Dashboard\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ocart\Core\Models\BaseModel;

class DashboardWidget extends BaseModel
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dashboard_widgets';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @return hasMany
     */
    public function settings()
    {
        return $this->hasMany(DashboardWidgetSetting::class, 'widget_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function (DashboardWidget $widget) {
            DashboardWidgetSetting::where('widget_id', $widget->id)->delete();
        });
    }
}

<?php

namespace Ocart\Dashboard\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DashboardWidgetSetting extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dashboard_widget_settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'settings',
        'user_id',
        'widget_id',
        'order',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();
    }
}
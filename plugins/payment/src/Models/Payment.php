<?php

namespace Ocart\Payment\Models;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Routing\UrlGenerator;
use Ocart\Core\Enums\BaseStatusEnum;
use Ocart\Core\Models\BaseModel;
use Ocart\Payment\Enums\PaymentMethodEnum;
use Ocart\Payment\Enums\PaymentStatusEnum;

class Payment extends BaseModel
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'payments';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'currency',
        'user_id',
        'charge_id',
        'payment_channel',
        'description',
        'amount',
        'order_id',
        'status',
        'payment_type',
        'customer_id',
        'refunded_amount',
        'refund_note',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'status' => PaymentStatusEnum::class,
        'payment_channel' => PaymentMethodEnum::class,
    ];

    protected static function boot()
    {
        parent::boot();
    }

    public function user()
    {
        return $this->belongsTo(Admin::class, 'user_id')->withDefault();
    }
}

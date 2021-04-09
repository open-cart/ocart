<?php

namespace Ocart\Payment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Routing\UrlGenerator;
use Ocart\Core\Enums\BaseStatusEnum;
use Ocart\Core\Models\BaseModel;
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
    ];

    protected static function boot()
    {
        parent::boot();
    }
}

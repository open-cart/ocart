<?php

namespace Ocart\Ecommerce\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Ocart\Core\Models\BaseModel;
use Ocart\Ecommerce\Enums\OrderStatusEnum;
use Ocart\Ecommerce\Repositories\Interfaces\ShipmentRepository;
use Ocart\Payment\Models\Payment;
use Ocart\Payment\Repositories\PaymentRepository;

class Order extends BaseModel
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ecommerce_orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'shipping_option',
        'shipping_method',
        'status',
        'amount',
        'currency_id',
        'tax_amount',
        'shipping_amount',
        'description',
        'coupon_code',
        'discount_amount',
        'sub_total',
        'is_confirmed',
        'discount_description',
        'is_finished',
        'token',
        'payment_id',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'status' => OrderStatusEnum::class,
    ];

    protected static function boot()
    {
        parent::boot();

        static::updating(function (Order $order) {
            if ($order->isDirty('description')) {
                $history = new OrderHistory();

                $history->fill([
                    'action'      => 'added_note',
                    'description' => '%user_name% added a note to this order',
                    'order_id'    => $order->id,
                    'user_id'     => \Auth::user()->getKey(),
                    'extras' => json_encode(['note' => $order->description])
                ]);

                $history->save();
            }
        });

        self::deleting(function (Order $order) {
            app(ShipmentRepository::class)->deleteWhere(['order_id' => $order->id]);
            Shipment::where('order_id', $order->id)->delete();
            OrderHistory::where('order_id', $order->id)->delete();
            OrderProduct::where('order_id', $order->id)->delete();
            OrderAddress::where('order_id', $order->id)->delete();
            app(PaymentRepository::class)->deleteWhere(['order_id' => $order->id]);
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id')->withDefault();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function address()
    {
        return $this->hasOne(OrderAddress::class, 'order_id')->withDefault();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(OrderProduct::class, 'order_id')->with(['product']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function histories()
    {
        return $this->hasMany(OrderHistory::class, 'order_id');
    }

    public function getCodeAttribute($value)
    {
        return '#' . str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }
}

<?php
namespace Ocart\Ecommerce\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Ocart\Core\Models\BaseModel;

class Store extends BaseModel
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ecommerce_stores';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'country',
        'state',
        'city',
        'is_primary',
        'is_shipping_location',
    ];
}
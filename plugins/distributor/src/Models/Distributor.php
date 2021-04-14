<?php

namespace Ocart\Distributor\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Ocart\Core\Models\BaseModel;

class Distributor extends BaseModel
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'distributors';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'phone',
        'address',
        'location',
    ];

    public function position()
    {
        return $this->hasOne(DistributorLocation::class, 'code', 'location');
    }
}

<?php

namespace Ocart\Distributor\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Ocart\Core\Models\BaseModel;

class DistributorLocation extends BaseModel
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'distribution_locations';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'code',
    ];
}

<?php


namespace Ocart\Core\Models;
use \Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public static function fire($callback = null)
    {
        return add_action(static::class, $callback);
    }

    public function __construct(array $attributes = [])
    {
        do_action(static::class, $this);
        parent::__construct($attributes);
    }
}

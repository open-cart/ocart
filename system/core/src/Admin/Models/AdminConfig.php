<?php


namespace Core\Admin\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminConfig extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $table = 'admin_config';
    protected $guarded = [];

//    protected static $getAll = null;
//    protected static $getAllGlobal = null;
//    protected static $getAllConfigOfStore = null;

    /**
     * get Plugin installed
     * @param  [type]  $code      Payment, Shipping,..
     * @param  boolean $onlyActive
     * @return [type]              [description]
     */
    public static function getPluginCode($onlyActive = true)
    {
        $query =  self::where('group', 'Plugins');
        if ($onlyActive) {
            $query = $query->where('value', 1);
        }
        $data = $query->orderBy('sort', 'asc')
            ->get()->keyBy('key');
        return $data;
    }

    /**
     * get Group
     * @param  [string]  $group
     * @param  [string]  $suffix
     * @return [type]              [description]
     */
    public static function getGroup($group = null, $suffix = null)
    {
        if ($group === null) {
            return [];
        }
        $return =  self::where('group', $group);
        if ($suffix) {
            $return = $return->orWhere('group', $group.'__'.$suffix);
        }
        $return = $return->orderBy('sort','desc')->pluck('value')->all();
        if ($return) {
            return $return;
        } else {
            return [];
        }
    }
}

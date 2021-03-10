<?php


namespace Ocart\Core\Library\MapData;

use Illuminate\Support\Collection;

class Builder
{
    protected $data;

    public function __construct()
    {
        $this->data = [];
    }

    public function register($name, $key = null, $default = null)
    {
        if (is_array($name)) {
            foreach ($name as $key => $value) {
                $this->register($key, $value, null);
            }
            return $this;
        }

        if (is_null($key)) {
            return $this;
        }

        if (!is_array($key)) {
           $key = [$key, $default];
        }

        $this->data[$name] = $key;
        return $this;
    }

    public function toArray()
    {
        $res = [];
        foreach ($this->data as $key => $value) {
            [$val, $def] = $value;
            if ($val instanceof \Closure) {
                $this->set($res, $key, $val(request()));
            } else {
                $this->set($res, $key, request()->input($val, $def));
            }
        }

        return $res;
    }

    protected function set(&$array, $key, $value)
    {
        return data_set($array, $key, $value, true);
    }
}

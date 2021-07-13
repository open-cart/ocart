<?php

namespace Ocart\Core\Supports;

use Illuminate\Support\Str;

class SlugSupport
{
    public function getPrefixes()
    {
        return config('core::general.prefixes', []);
    }

    public function registerPrefix($name, $value)
    {
        $prefixes = $this->getPrefixes();

        if (!is_array($name)) {
            $prefixes[$name] = $value;
        } else {
            foreach ($name as $key => $value) {
                $prefixes[$key] = $value;
            }
        }

        config(['core::general.prefixes' => $prefixes]);

        return $this;
    }

    public function getPrefix($model, $default = null)
    {
        $permalink = setting($this->getPermalinkSettingKey($model));

        if ($permalink !== null) {
            return $permalink;
        }

        $prefixes = $this->getPrefixes();

        $config = \Arr::get($prefixes, $model . '.value');

        if ($config !== null) {
            return $config;
        }

        return $default;
    }

    public function getPermalinkSettingKey($key)
    {
        return 'permalink-' . Str::slug(str_replace('\\', '_', $key));
    }
}
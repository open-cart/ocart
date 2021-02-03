<?php


namespace Core\Library\Menu\Traits;


Trait HasRoute
{
    /**
     * @var string|null
     */
    protected $routeName = '';

    /**
     * @return string|null
     */
    public function routeName()
    {
        return $this->routeName;
    }

    /**
     * @param string $name
     * @param string $text
     * @return static
     */
    public static function route(string $name, string $text)
    {
        $instance = self::to('', $text);
        $instance->routeName = $name;
        return $instance;
    }
}

<?php


namespace Core\Library\Menu;


use Core\Library\Menu\Traits\HasParentAttributes;
use Core\Library\Menu\Traits\HasRoute;

class Html
{
    use HasParentAttributes;
    use HasRoute;

    /** @var string */
    protected $html;

    /** @var string|null */
    protected $url = null;

    /** @var bool */
    protected $active = false;

    /** @var Attributes */
    protected $parentAttributes;

    /**
     * @param string $html
     */
    protected function __construct(string $html)
    {
        $this->html = $html;
        $this->parentAttributes = new Attributes();
    }

    /**
     * Create an item containing a chunk of raw html.
     *
     * @param string $html
     *
     * @return static
     */
    public static function raw(string $html)
    {
        return new static($html);
    }

    /**
     * Create an empty item.
     *
     * @return static
     */
    public static function empty()
    {
        return new static('');
    }

    /**
     * @return string
     */
    public function html(): string
    {
        return $this->html;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        return $this->html;
    }
}

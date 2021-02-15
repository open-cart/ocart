<?php


namespace System\Core\Library\Menu;


use System\Core\Library\Menu\Traits\HasHtmlAttributes;
use System\Core\Library\Menu\Traits\HasParentAttributes;
use System\Core\Library\Menu\Traits\HasRoute;

class Link
{
    use HasHtmlAttributes;
    use HasParentAttributes;
    use HasRoute;

    protected $attributes = array();


    protected $text = '';

    /**
     * @var null | string
     */
    protected $url = null;

    /** @var string */
    protected $prepend;
    protected $append = '';

    /** @var bool */
    protected $active = false;

    /** @var Attributes */
    protected $htmlAttributes;
    protected $parentAttributes;

    /**
     * @param string $url
     * @param string $text
     */
    public function __construct(string $url, string $text)
    {
        $this->url = $url;
        $this->text = $text;
        $this->htmlAttributes = new Attributes();
        $this->parentAttributes = new Attributes();
    }

    /**
     * @param string $url
     * @param string $text
     *
     * @return static
     */
    public static function to(string $url, string $text)
    {
        return new static($url, $text);
    }

    /**
     * @return string
     */
    public function text(): string
    {
        return $this->text;
    }

    /**
     * @return $this
     */
    public static function noLink(string $text)
    {
        $item = new static('javascript:void(0)', $text);
        return $item;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        $attributes = new Attributes(['href' => $this->routeName ? route($this->routeName) : $this->url]);
        $attributes->mergeWith($this->htmlAttributes);

        return $this->prepend."<a {$attributes}>{$this->text}</a>".$this->append;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->render();
    }
}

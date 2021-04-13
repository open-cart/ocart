<?php

namespace Ocart\Shortcode\View;

use Ocart\Shortcode\Compilers\ShortcodeCompiler;

class View extends \Illuminate\View\View
{
    /**
     * @var ShortcodeCompiler
     */
    public $shortcode;

    public function setShortcode(ShortcodeCompiler $shortcode)
    {
        $this->shortcode = $shortcode;
    }

    /**
     * Enable the shortcodes
     * @since 2.1
     */
    public function withShortcodes()
    {
        $this->shortcode->enable();

        return $this;
    }

    /**
     * Disable the shortcodes
     * @since 2.1
     */
    public function withoutShortcodes()
    {
        $this->shortcode->disable();

        return $this;
    }

    /**
     * @return $this
     * @since 2.1
     */
    public function withStripShortcodes()
    {
        $this->shortcode->setStrip(true);

        return $this;
    }

    /**
     * Get the contents of the view instance.
     *
     * @return string
     * @since 2.1
     */
    protected function renderContents()
    {
        // We will keep track of the amount of views being rendered so we can flush
        // the section after the complete rendering operation is done. This will
        // clear out the sections for any separate views that may be rendered.
        $this->factory->incrementRender();
        $this->factory->callComposer($this);
        $contents = $this->getContents();

        if ($this->shortcode->getStrip()) {
            // strip content without shortcodes
            $contents = $this->shortcode->strip($contents);
        } else {
            // compile the shortcodes
            $contents = $this->shortcode->compile($contents);
        }

        // Once we've finished rendering the view, we'll decrement the render count
        // so that each sections get flushed out next time a view is created and
        // no old sections are staying around in the memory of an environment.
        $this->factory->decrementRender();

        return $contents;
    }
}
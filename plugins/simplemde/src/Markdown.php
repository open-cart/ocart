<?php

namespace Ocart\SimpleMDE;

use Illuminate\Support\HtmlString;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment;
use League\CommonMark\Extension\Table\TableExtension;

class Markdown
{

    /**
     * Parse the given Markdown text into HTML.
     *
     * @param  string  $text
     * @return \Illuminate\Support\HtmlString
     */
    public static function parse($text)
    {
        $environment = Environment::createCommonMarkEnvironment();

        $environment->addExtension(new TableExtension);

        $converter = new CommonMarkConverter([
            'allow_unsafe_links' => false,
            'html_input' => \League\CommonMark\EnvironmentInterface::HTML_INPUT_ESCAPE
        ], $environment);

        return new HtmlString($converter->convertToHtml($text));
    }
}
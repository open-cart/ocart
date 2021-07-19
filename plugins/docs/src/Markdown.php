<?php

namespace Ocart\Docs;

use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment;
use League\CommonMark\Extension\Autolink\AutolinkExtension;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\Extension\Attributes\AttributesExtension;
use \League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkProcessor;
use \League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;
use League\CommonMark\Extension\Mention\MentionExtension;
use League\CommonMark\Extension\Mention\Generator\MentionGeneratorInterface;
use League\CommonMark\Extension\Mention\Mention;
use League\CommonMark\Inline\Element\AbstractInline;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkRenderer;

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
        $environment->addExtension(new AttributesExtension());
        $environment->addExtension(new HeadingPermalinkExtension());
        $environment->addExtension(new MentionExtension());
        $environment->addExtension(new AutolinkExtension());

        $environment->mergeConfig([
            'heading_permalink' => [
//                'insert' => HeadingPermalinkProcessor::INSERT_AFTER,
                'symbol' => '#',
                'id_prefix' => '',
//                'inner_contents' => HeadingPermalinkRenderer::DEFAULT_INNER_CONTENTS,
            ],
            'mentions' => [
                // GitHub handler mention configuration.
                // Sample Input:  `@colinodell`
                // Sample Output: `<a href="https://www.github.com/colinodell">@colinodell</a>`
                'docs_handle' => [
                    'prefix'    => '@',
                    'pattern'   => '(.*)',
//                'generator' => '#%s',
                    'generator' => new class implements MentionGeneratorInterface {
                        public function generateMention(Mention $mention): ?AbstractInline
                        {
                            $mention->setUrl(\sprintf('#%s', Str::slug($mention->getIdentifier())));
                            $mention->setLabel($mention->getIdentifier());

                            return $mention;
                        }
                    },
                ],
            ]
        ]);

        $converter = new CommonMarkConverter([
            'allow_unsafe_links' => false,
            'html_input' => \League\CommonMark\EnvironmentInterface::HTML_INPUT_ESCAPE
        ], $environment);

        return new HtmlString($converter->convertToHtml($text));
    }
}
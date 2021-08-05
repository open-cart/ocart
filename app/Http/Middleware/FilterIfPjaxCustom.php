<?php

namespace App\Http\Middleware;

use Assets;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Response as BaseResponse;
use Closure;

class FilterIfPjaxCustom extends \Spatie\Pjax\Middleware\FilterIfPjax
{
    /** @var \Symfony\Component\DomCrawler\Crawler */
    protected $crawler;

    public function handle(Request $request, Closure $next): BaseResponse
    {
        $response = $next($request);

        if (! $request->pjax() || $response->isRedirection()) {
            return $response;
        }

        $this->renderResponse($response, $request->header('X-PJAX-Container'))
            ->setUriHeader($response, $request)
            ->setVersionHeader($response, $request);

        return $response;
    }

    protected function renderResponse(BaseResponse $response, $container)
    {
        $crawler = $this->getCrawler($response);

        $response->setContent(
            '<div id="pjax-head">'.$this->makeTitle($crawler). $this->makeTransient($crawler) . '</div>'.
            '<div id="js-check-all-container">' . $this->fetchContainer($crawler, $container) . '</div>'
            . Assets::renderBody() . Assets::renderFooter()
            . $this->makeReplace($crawler)
        );

        return $this;
    }

    protected function makeReplace(Crawler $crawler)
    {
        $transient = $crawler->filter('div[data-pjax-replace]');

        $html = '';

        foreach ($transient as $node) {
            $owner = $node->ownerDocument;
            $html .= $owner->saveHTML($node);
        }

        return $html;
    }

    protected function makeTransient(Crawler $crawler)
    {
        $transient = $crawler->filter('head meta[data-pjax-transient]');

        $html = '';

        foreach ($transient as $node) {
            $owner = $node->ownerDocument;
            $html .= $owner->saveHTML($node);
        }

        return $html;
    }
}
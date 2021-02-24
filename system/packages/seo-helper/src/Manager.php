<?php


namespace Ocart\SeoHelper;


use Artesaos\SEOTools\Contracts\JsonLd;
use Artesaos\SEOTools\Contracts\JsonLdMulti;
use Artesaos\SEOTools\Contracts\MetaTags;
use Artesaos\SEOTools\Contracts\OpenGraph;
use Artesaos\SEOTools\Contracts\TwitterCards;

class Manager
{
    protected $seoOpenGraph;

    protected $seoMetaTags;
    protected $seoTwitterCards;
    protected $seoJsonLd;
    protected $seoJsonLdMulti;

    public function __construct(
        MetaTags $seoMetaTags,
        TwitterCards $seoTwitterCards,
        JsonLd $seoJsonLd,
        JsonLdMulti $seoJsonLdMulti,
        OpenGraph $seoOpenGraph
    )
    {
        $this->seoOpenGraph = $seoOpenGraph;
        $this->seoMetaTags = $seoMetaTags;
        $this->seoTwitterCards = $seoTwitterCards;
        $this->seoJsonLd = $seoJsonLd;
        $this->seoJsonLdMulti = $seoJsonLdMulti;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->openGraph()->setTitle($title);
        $this->metaTags()->setTitle($title);
    }

    public function setDescription($description)
    {
        $this->openGraph()->setDescription($description);
        $this->metaTags()->setDescription($description);
    }

    /**
     * @param mixed $seoOpenGraph
     */
    public function setSeoOpenGraph($seoOpenGraph): void
    {
        $this->seoOpenGraph = $seoOpenGraph;
    }

    /**
     * @return OpenGraph
     */
    public function openGraph()
    {
        return $this->seoOpenGraph;
    }

    /**
     * @param MetaTags $seoMetaTags
     */
    public function setSeoMetaTags(MetaTags $seoMetaTags): void
    {
        $this->seoMetaTags = $seoMetaTags;
    }

    /**
     * @return MetaTags
     */
    public function metaTags(): MetaTags
    {
        return $this->seoMetaTags;
    }

    /**
     * @return TwitterCards
     */
    public function twitterCards(): TwitterCards
    {
        return $this->seoTwitterCards;
    }

    /**
     * @param TwitterCards $seoTwitterCards
     */
    public function setSeoTwitterCards(TwitterCards $seoTwitterCards): void
    {
        $this->seoTwitterCards = $seoTwitterCards;
    }

    /**
     * @param JsonLd $seoJsonLd
     */
    public function setSeoJsonLd(JsonLd $seoJsonLd): void
    {
        $this->seoJsonLd = $seoJsonLd;
    }

    /**
     * @return JsonLd
     */
    public function jsonLd(): JsonLd
    {
        return $this->seoJsonLd;
    }

    /**
     * @return JsonLdMulti
     */
    public function jsonLdMulti(): JsonLdMulti
    {
        return $this->seoJsonLdMulti;
    }

    /**
     * @param JsonLdMulti $seoJsonLdMulti
     */
    public function setSeoJsonLdMulti(JsonLdMulti $seoJsonLdMulti): void
    {
        $this->seoJsonLdMulti = $seoJsonLdMulti;
    }

    /**
     * @return mixed
     */
    public function render()
    {
        return app('seotools')->generate();
    }

    public function __toString()
    {
        return $this->render();
    }
}

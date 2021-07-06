<?php


namespace Ocart\SeoHelper;


use Artesaos\SEOTools\Contracts\JsonLd;
use Artesaos\SEOTools\Contracts\JsonLdMulti;
use Artesaos\SEOTools\Contracts\MetaTags;
use Artesaos\SEOTools\Contracts\OpenGraph;
use Artesaos\SEOTools\Contracts\TwitterCards;
use Ocart\Core\Facades\MetaBox;

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
        $this->jsonLd()->setTitle($title);
    }

    public function setDescription($description)
    {
        $this->openGraph()->setDescription($description);
        $this->metaTags()->setDescription($description);
        $this->jsonLd()->setDescription($description);
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

    /**
     * @param $model
     * @param \Illuminate\Http\Request $request
     * @param $repository
     */
    public function saveMetaData($model, \Illuminate\Http\Request $request, $repository)
    {
        if (!in_array(get_class($model), config('packages.seo-helper.general.supported', []))) {
            return false;
        }

        try {
            if (empty($request->input('seo_meta'))) {
                $this->deleteMetaData($model, 'seo_meta');
                return false;
            }

            MetaBox::saveMetaBoxData($model, 'seo_meta', $request->input('seo_meta'));
            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function deleteMetaData($model, $key)
    {
        if (in_array(get_class($model), config('packages.seo-helper.general.supported', []))) {
            MetaBox::deleteMetaData($model, $key);
            return true;
        }
        return false;
    }

    /**
     * @param string | array $model
     * @return $this
     */
    public function registerModule($model)
    {
        if (!is_array($model)) {
            $model = [$model];
        }
        config([
            'packages.seo-helper.general.supported' => array_merge(config('packages.seo-helper.general.supported', []),
                $model),
        ]);
        return $this;
    }
}

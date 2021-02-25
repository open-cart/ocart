<?php


namespace Ocart\SeoHelper\Providers;


use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Ocart\SeoHelper\Facades\SeoHelper;
use System\Core\Traits\LoadAndPublishDataTrait;

class SeoHelperServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        add_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, [$this, 'setSeoMeta'], 1, 2);
//        add_action(BASE_ACTION_META_BOXES, [$this, 'addMetaBox'], 12, 3);
    }

    public function boot()
    {
        $this->setNamespace('packages/seo-helper')
            ->loadAndPublishConfigurations([])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->publishAssets();

        AliasLoader::getInstance(['SeoHelper' => SeoHelper::class]);
    }

    public function setSeoMeta($screen, $object) {
        $meta = get_meta_data($object, 'seo_meta', true);
        if (!empty($meta)) {
            if (!empty($meta['seo_title'])) {
                SeoHelper::setTitle($meta['seo_title']);
            }

            if (!empty($meta['seo_description'])) {
                SeoHelper::setDescription($meta['seo_description']);
            }
        }
    }

    public function addMetaBox()
    {
        $meta = [
            'seo_title'       => null,
            'seo_description' => null,
        ];

        $args = func_get_args();

        if (!empty($args[2]) && $args[2]->id) {
            $metadata = get_meta_data($args[2], 'seo_meta', true);
        }

        if (!empty($metadata) && is_array($metadata)) {
            $meta = array_merge($meta, $metadata);
        }

        $object = $args[2];

        return view('packages/seo-helper::meta_box', compact('meta', 'object'));
    }
}

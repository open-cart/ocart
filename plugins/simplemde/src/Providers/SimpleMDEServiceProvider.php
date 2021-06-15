<?php

namespace Ocart\SimpleMDE\Providers;
use Ocart\Core\Forms\Field;
use Illuminate\Support\ServiceProvider;
use Ocart\Core\Traits\LoadAndPublishDataTrait;

class SimpleMDEServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {

//        $this->publishAssets(['js']);

        add_filter(BASE_FILTER_BEFORE_RENDER_FORM, function ($a,$b,$c) {
            if (in_array($b, ['blog_post', 'blog_category'])) {
                $a->add('content', Field::TEXTAREA, [
                    'label' => trans('plugins/blog::posts.content'),
                    'attr' => [
//            'class' => $this->formHelper->getConfig('defaults.field_class') . ' editor-full'
                        'id' => 'editor-simplemde'
                    ]
                ], true);
            }
            return $a;
        },1, 3);

        add_action(BASE_ACTION_META_BOXES, function ($a, $b, $c) {
            if ($b != 'side') {
                return;
            }
            echo '
<script>
renderSimplemde("editor-simplemde");
</script>
<style>
.CodeMirror .cm-spell-error:not(.cm-url):not(.cm-comment):not(.cm-tag):not(.cm-word) {
background: none !important;
}
@media (prefers-color-scheme: dark) {
    .editor-toolbar:not(.fullscreen) a {
        color: white !important;
    }
    .editor-toolbar a.active, .editor-toolbar a:hover {
        color: #2c3e50 !important;
    }
}
</style>
            ';
        }, 999, 3);

        $scripts = config('assets.scripts');
        $styles = config('assets.styles');

        $scripts[] = 'simplemde';
        $scripts[] = 'simplemde_custom';
        $scripts[] = 'prismjs';
        $styles[] = 'simplemde';
        $styles[] = 'prismjs';

        $resourceScript = config('assets.resources.scripts');
        $resourceScript['simplemde_custom'] = [
            'use_cdn'  => true,
            'location' => 'header',
            'src'      => [
                'local' => 'access/simplemde/custom.js',
            ]
        ];

        config()->set('assets.resources.scripts', $resourceScript);
        config()->set('assets.scripts', $scripts);
        config()->set('assets.styles', $styles);
    }
}
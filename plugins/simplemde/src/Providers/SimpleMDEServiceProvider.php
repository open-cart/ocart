<?php

namespace Ocart\SimpleMDE\Providers;
use Botble\Assets\Facades\AssetsFacade;
use Illuminate\Support\Str;
use Ocart\Blog\Forms\CategoryForm;
use Ocart\Blog\Forms\PostForm;
use Ocart\Core\Forms\Field;
use Illuminate\Support\ServiceProvider;
use Ocart\Core\Traits\LoadAndPublishDataTrait;

class SimpleMDEServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        $that = $this;
        add_filter(BASE_FILTER_BEFORE_RENDER_FORM, function ($a,$b,$c) use($that) {
            if (method_exists($that, 'addFilterRenderForm' . Str::ucfirst(Str::camel($b)))) {
                $that->{'addFilterRenderForm' . Str::ucfirst(Str::camel($b))}($a);
            }

            return $a;
        },1, 3);

        add_action(BASE_ACTION_META_BOXES, function ($a, $b, $c) use($that) {
            if ($b != 'side') {
                return;
            }
            $that->addActionMetaBoxes();
        }, 999, 3);

        AssetsFacade::addStylesDirectly([
            'access/simplemde/simplemde.min.css',
            'access/prismjs/prism.css'
        ])
            ->addScriptsDirectly([
                'access/simplemde/simplemde.min.js',
                'access/prismjs/prism.js',
                'access/simplemde/custom.js'
            ]);
    }

    public function addFilterRenderFormBlogPost(PostForm $form)
    {
        $form->add('content', Field::TEXTAREA, [
            'label' => trans('plugins/blog::posts.content'),
            'attr' => [
                'id' => 'editor-simplemde'
            ]
        ], true);
    }

    public function addFilterRenderFormBlogCategory(CategoryForm $form)
    {
        $form->add('description', Field::TEXTAREA, [
            'label'      => trans('plugins/blog::categories.description'),
            'attr' => [
                'id' => 'editor-simplemde'
            ]
        ], true);
    }

    public function addActionMetaBoxes()
    {
        echo '
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
    }
}
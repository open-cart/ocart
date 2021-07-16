<?php

namespace Ocart\Docs\Providers;

use Illuminate\Support\ServiceProvider;
use Kris\LaravelFormBuilder\Field;
use Ocart\Blog\Models\Post;
use Ocart\Core\Traits\LoadAndPublishDataTrait;
use Ocart\Docs\Repositories\Criteria\FilterVersionCriteria;

class DocsServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {

        $this
            ->setBasePath(base_path() . '/')
            ->setNamespace('plugins/docs')
            ->loadRoutes(['web'])
            ->loadAndPublishViews();

        config()->set('const.ADMIN_PREFIX', 'admin/v1');

        add_filter(BASE_FILTER_TOP_HEADER_LAYOUT, [$this, 'registerTopHeaderVersion']);

        add_filter(BASE_FILTER_BEFORE_RENDER_FORM, [$this, 'addFilterPost'], 99, 3);

        add_filter(BASE_FILTER_TABLE_QUERY, [$this, 'registerTableQuery'], 99, 2);
    }


    public function registerTopHeaderVersion($options)
    {
        return $options . view('plugins.docs::dropdown-version');
    }

    public function addFilterPost($form, $module, $data)
    {
        if ($module === 'post-filter') {
            $versions = [
                '1.0' => 'version 1.0',
            ];
            $form->add('version', Field::SELECT, [
                'label' => trans('plugins/ecommerce::orders.status'),
                'choices' => $versions,
                'labels' => $versions,
                'wrapper_class' => 'col-span-2',
                'attr' => [
                    'placeholder' => '--Select version--',
                ]
            ]);
            return $form;
        }

        return $form;
    }

    public function registerTableQuery($repo, $data)
    {
        if ($repo->getModel() instanceof Post) {
            $repo->pushCriteria(FilterVersionCriteria::class);
        }

        return $repo;
    }
}
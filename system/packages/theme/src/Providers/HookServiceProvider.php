<?php

namespace Ocart\Theme\Providers;

use Illuminate\Support\ServiceProvider;
use Ocart\Core\Forms\Field;

class HookServiceProvider extends ServiceProvider
{
    public function boot()
    {
        theme_options()
            ->setSection([
                'title' =>  trans('packages/theme::theme.theme_option_general'),
                'desc' =>  trans('packages/theme::theme.theme_option_general_description'),
                'id' => 'opt-general',
                'icon' => 'fa fa-home',
                'fields' => [
                    [
                        'id' => 'site_title',
                        'type' => Field::TEXT,
                        'name' => 'site_title',
                        'label' => trans('Site title'),
                        'attr' => [
                            'placeholder' => trans('Site title'),
                        ]
                    ],
                    [
                        'id' => 'seo_title',
                        'type' => Field::TEXT,
                        'name' => 'seo_title',
                        'label' => trans('Seo title'),
                        'attr' => [
                            'placeholder' => trans('Seo title'),
                        ]
                    ],
                    [
                        'id' => 'seo_description',
                        'type' => Field::TEXT,
                        'name' => 'seo_description',
                        'label' => trans('Seo description'),
                        'attr' => [
                            'placeholder' => trans('Seo description'),
                        ]
                    ],
                    [
                        'id' => 'seo_og_image',
                        'type' => Field::MEDIA_IMAGE,
                        'name' => 'seo_og_image',
                        'label' => trans('SEO default Open Graph image'),
                    ],
                ]
            ])
            ->setSection([
                'title' => 'Logo',
                'desc' => 'Description',
                'id' => 'opt-logo',
                'icon' => 'fa fa-image',
                'fields' => [
                    [
                        'id' => 'favicon',
                        'type' => Field::MEDIA_IMAGE,
                        'name' => 'favicon',
                    ],
                    [
                        'id' => 'logo',
                        'type' => Field::MEDIA_IMAGE,
                        'name' => 'logo',
                    ]
                ]
            ]);
    }

}
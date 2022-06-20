<?php
use \Illuminate\Routing\Events\RouteMatched;
use \Illuminate\Support\Facades\Event;
use Ocart\Core\Forms\Field;

Event::listen(RouteMatched::class, function () {
    $blog_categories = [];
    function dequy($n, &$arr = [], $level = ''){
        foreach ($n as $item){
            $arr[$item->id] = $level . $item->name;

            if ($item->child_cats->count()){
                dequy($item->child_cats, $arr, $level . '---');
            }
        }
    }
    dequy(get_blog_categories(), $blog_categories);

    $blog_categories = [0 => 'None'] + $blog_categories;
    theme_options()->setField([
        'id' => 'domain_web',
        'section_id' => 'opt-general',
        'type' => Field::TEXT,
        'name' => 'domain_web',
        'label' => trans('Domain Web'),
        'attr' => [
            'placeholder' => trans('Domain Web'),
        ]
    ])->setField([
        'id' => 'meta_header',
        'section_id' => 'opt-general',
        'type' => Field::TEXTAREA,
        'name' => 'meta_header',
        'label' => trans('Meta Header'),
        'attr' => [
            'placeholder' => trans('Code'),
            'inline' => true,
            'rows' => 3,
        ]
    ])->setField([
        'id' => 'meta_footer',
        'section_id' => 'opt-general',
        'type' => Field::TEXTAREA,
        'name' => 'meta_footer',
        'label' => trans('Meta Footer'),
        'attr' => [
            'placeholder' => trans('Code'),
            'inline' => true,
            'rows' => 3,
        ]
    ])->setField([
        'id' => 'style_custom',
        'section_id' => 'opt-general',
        'type' => Field::TEXTAREA,
        'name' => 'style_custom',
        'label' => trans('Css Custom'),
        'attr' => [
            'placeholder' => trans('Code Css'),
            'inline' => true,
            'rows' => 3,
        ]
    ])->setField([
        'id' => 'address1',
        'section_id' => 'opt-general',
        'type' => Field::TEXT,
        'name' => 'address1',
        'label' => trans('Address') . ' 1',
        'attr' => [
            'placeholder' => trans('Address') . ' 2',
        ]
    ])->setField([
        'id' => 'address2',
        'section_id' => 'opt-general',
        'type' => Field::TEXT,
        'name' => 'address2',
        'label' => trans('Address') . ' 2',
        'attr' => [
            'placeholder' => trans('Address') . ' 2',
        ]
    ])->setField([
        'id' => 'phone1',
        'section_id' => 'opt-general',
        'type' => Field::TEXT,
        'name' => 'phone1',
        'label' => trans('Hotline 1'),
        'attr' => [
            'placeholder' => trans('Phone 1 Number'),
        ]
    ])->setField([
        'id' => 'phone2',
        'section_id' => 'opt-general',
        'type' => Field::TEXT,
        'name' => 'phone2',
        'label' => trans('Hotline 2'),
        'attr' => [
            'placeholder' => trans('Phone 2 Number'),
        ]
    ])->setField([
        'id' => 'email',
        'section_id' => 'opt-general',
        'type' => Field::TEXT,
        'name' => 'email',
        'label' => trans('Email'),
        'attr' => [
            'placeholder' => trans('Email'),
        ]
    ])->setField([
        'id' => 'chat_zalo',
        'section_id' => 'opt-general',
        'type' => Field::TEXT,
        'name' => 'chat_zalo',
        'label' => trans('Chat Zalo'),
        'attr' => [
            'placeholder' => trans('Chat Zalo'),
        ]
    ])->setField([
        'id' => 'chat_facebook',
        'section_id' => 'opt-general',
        'type' => Field::TEXT,
        'name' => 'chat_facebook',
        'label' => trans('Chat Facebook'),
        'attr' => [
            'placeholder' => trans('Chat Facebook'),
        ]
    ])->setField([
        'id' => 'link_contact',
        'section_id' => 'opt-general',
        'type' => Field::TEXT,
        'name' => 'link_contact',
        'label' => trans('Link Contact'),
        'attr' => [
            'placeholder' => trans('Link Contact'),
        ]
    ])->setField([
        'id' => 'section_list',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'section_list',
        'label' => trans('Section List'),
        'attr' => [
            'placeholder' => trans('["sec1","sec4","sec5","sec6","sec7","sec9","sec11","sec12"]'),
        ]
    ])->setField([
        'id' => 'link_slide1',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'link_slide1',
        'label' => trans('Section 1 Link'),
        'attr' => [
            'placeholder' => trans('Link'),
        ]
    ])->setField([
        'id' => 'slide1',
        'section_id' => 'opt-sections',
        'type' => Field::MEDIA_IMAGE,
        'name' => 'slide1',
        'label' => trans('Section 1 Slide'),
        'attr' => [
            'placeholder' => trans('Image'),
        ]
    ])->setField([
        'id' => 'link_slide1_2',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'link_slide1_2',
        'label' => trans('Section 1.2 Link'),
        'attr' => [
            'placeholder' => trans('Link'),
        ]
    ])->setField([
        'id' => 'slide1_2',
        'section_id' => 'opt-sections',
        'type' => Field::MEDIA_IMAGE,
        'name' => 'slide1_2',
        'label' => trans('Section 1.2 Slide'),
        'attr' => [
            'placeholder' => trans('Image'),
        ]
    ])->setField([
        'id' => 'link_slide1_3',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'link_slide1_3',
        'label' => trans('Section 1.3 Link'),
        'attr' => [
            'placeholder' => trans('Link'),
        ]
    ])->setField([
        'id' => 'slide1_3',
        'section_id' => 'opt-sections',
        'type' => Field::MEDIA_IMAGE,
        'name' => 'slide1_3',
        'label' => trans('Section 1.3 Slide'),
        'attr' => [
            'placeholder' => trans('Image'),
        ]
    ])->setField([
        'id' => 'link_grid1',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'link_grid1',
        'label' => trans('Section 2 Link'),
        'attr' => [
            'placeholder' => trans('Link'),
        ]
    ])->setField([
        'id' => 'grid1',
        'section_id' => 'opt-sections',
        'type' => Field::MEDIA_IMAGE,
        'name' => 'grid1',
        'label' => trans('Section 2 Grid'),
        'attr' => [
            'placeholder' => trans('Image'),
        ]
    ])->setField([
        'id' => 'link_grid1_2',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'link_grid1_2',
        'label' => trans('Section 2.2 Link'),
        'attr' => [
            'placeholder' => trans('Link'),
        ]
    ])->setField([
        'id' => 'grid1_2',
        'section_id' => 'opt-sections',
        'type' => Field::MEDIA_IMAGE,
        'name' => 'grid1_2',
        'label' => trans('Section 2.2 Grid'),
        'attr' => [
            'placeholder' => trans('Image'),
        ]
    ])->setField([
        'id' => 'link_grid1_3',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'link_grid1_3',
        'label' => trans('Section 2.3 Link'),
        'attr' => [
            'placeholder' => trans('Link'),
        ]
    ])->setField([
        'id' => 'grid1_3',
        'section_id' => 'opt-sections',
        'type' => Field::MEDIA_IMAGE,
        'name' => 'grid1_3',
        'label' => trans('Section 2.3 Grid'),
        'attr' => [
            'placeholder' => trans('Image'),
        ]
    ])->setField([
        'id' => 'link_grid1_4',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'link_grid1_4',
        'label' => trans('Section 2.4 Link'),
        'attr' => [
            'placeholder' => trans('Link'),
        ]
    ])->setField([
        'id' => 'grid1_4',
        'section_id' => 'opt-sections',
        'type' => Field::MEDIA_IMAGE,
        'name' => 'grid1_4',
        'label' => trans('Section 2.4 Grid'),
        'attr' => [
            'placeholder' => trans('Image'),
        ]
    ])->setField([
        'id' => 'link_grid1_5',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'link_grid1_5',
        'label' => trans('Section 2.5 Link'),
        'attr' => [
            'placeholder' => trans('Link'),
        ]
    ])->setField([
        'id' => 'grid1_5',
        'section_id' => 'opt-sections',
        'type' => Field::MEDIA_IMAGE,
        'name' => 'grid1_5',
        'label' => trans('Section 2.5 Grid'),
        'attr' => [
            'placeholder' => trans('Image'),
        ]
    ])->setField([
        'id' => 'link_grid1_6',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'link_grid1_6',
        'label' => trans('Section 2.6 Link'),
        'attr' => [
            'placeholder' => trans('Link'),
        ]
    ])->setField([
        'id' => 'grid1_6',
        'section_id' => 'opt-sections',
        'type' => Field::MEDIA_IMAGE,
        'name' => 'grid1_6',
        'label' => trans('Section 2.6 Grid'),
        'attr' => [
            'placeholder' => trans('Image'),
        ]
    ])->setField([
        'id' => 'title_product1',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'title_product1',
        'label' => trans('Section 4 Title'),
    ])->setField([
        'id' => 'deps_product1',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'deps_product1',
        'label' => trans('Section 4 Deps'),
    ])->setField([
        'id' => 'icon_about1',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'icon_about1',
        'label' => trans('Section 5 Icon'),
    ])->setField([
        'id' => 'title_about1',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'title_about1',
        'label' => trans('Section 5 Title'),
    ])->setField([
        'id' => 'deps_about1',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'deps_about1',
        'label' => trans('Section 5 Deps'),
    ])->setField([
        'id' => 'icon_about1_2',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'icon_about1_2',
        'label' => trans('Section 5.2 Icon'),
    ])->setField([
        'id' => 'title_about1_2',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'title_about1_2',
        'label' => trans('Section 5.2 Title'),
    ])->setField([
        'id' => 'deps_about1_2',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'deps_about1_2',
        'label' => trans('Section 5.2 Deps'),
    ])->setField([
        'id' => 'icon_about1_3',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'icon_about1_3',
        'label' => trans('Section 5.3 Icon'),
    ])->setField([
        'id' => 'title_about1_3',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'title_about1_3',
        'label' => trans('Section 5.3 Title'),
    ])->setField([
        'id' => 'deps_about1_3',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'deps_about1_3',
        'label' => trans('Section 5.3 Deps'),
    ])->setField([
        'id' => 'title_product2',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'title_product2',
        'label' => trans('Section 6 Title'),
    ])->setField([
        'id' => 'deps_product2',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'deps_product2',
        'label' => trans('Section 6 Deps'),
    ])->setField([
        'id' => 'title_testimonial1',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'title_testimonial1',
        'label' => trans('Section 7 Title'),
    ])->setField([
        'id' => 'link_testimonial1',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'link_testimonial1',
        'label' => trans('Section 7 Link'),
    ])->setField([
        'id' => 'deps_testimonial1',
        'section_id' => 'opt-sections',
        'type' => Field::TEXTAREA,
        'name' => 'deps_testimonial1',
        'label' => trans('Section 7 Deps'),
        'attr' => [
            'inline' => true,
            'rows' => 3,
        ]
    ])->setField([
        'id' => 'image_testimonial1',
        'section_id' => 'opt-sections',
        'type' => Field::MEDIA_IMAGE,
        'name' => 'image_testimonial1',
        'label' => trans('Section 7 Image'),
        'attr' => [
            'placeholder' => trans('Image'),
        ]
    ])->setField([
        'id' => 'title_testimonial1_2',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'title_testimonial1_2',
        'label' => trans('Section 7.2 Title'),
    ])->setField([
        'id' => 'link_testimonial1_2',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'link_testimonial1_2',
        'label' => trans('Section 7.2 Link'),
    ])->setField([
        'id' => 'deps_testimonial1_2',
        'section_id' => 'opt-sections',
        'type' => Field::TEXTAREA,
        'name' => 'deps_testimonial1_2',
        'label' => trans('Section 7.2 Deps'),
        'attr' => [
            'inline' => true,
            'rows' => 3,
        ]
    ])->setField([
        'id' => 'image_testimonial1_2',
        'section_id' => 'opt-sections',
        'type' => Field::MEDIA_IMAGE,
        'name' => 'image_testimonial1_2',
        'label' => trans('Section 7.2 Image'),
        'attr' => [
            'placeholder' => trans('Image'),
        ]
    ])->setField([
        'id' => 'title_testimonial1_3',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'title_testimonial1_3',
        'label' => trans('Section 7.3 Title'),
    ])->setField([
        'id' => 'link_testimonial1_3',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'link_testimonial1_3',
        'label' => trans('Section 7.3 Link'),
    ])->setField([
        'id' => 'deps_testimonial1_3',
        'section_id' => 'opt-sections',
        'type' => Field::TEXTAREA,
        'name' => 'deps_testimonial1_3',
        'label' => trans('Section 7.3 Deps'),
        'attr' => [
            'inline' => true,
            'rows' => 3,
        ]
    ])->setField([
        'id' => 'image_testimonial1_3',
        'section_id' => 'opt-sections',
        'type' => Field::MEDIA_IMAGE,
        'name' => 'image_testimonial1_3',
        'label' => trans('Section 7.3 Image'),
        'attr' => [
            'placeholder' => trans('Image'),
        ]
    ])->setField([
        'id' => 'product3',
        'section_id' => 'opt-sections',
        'type' => Field::TEXTAREA,
        'name' => 'product3',
        'label' => trans('Section 8'),
        'attr' => [
            'placeholder' => trans('[{"name":"name","slug":"slug","id":"id","children":[{"name":"name","slug":"slug"},{"name":"name","slug":"slug"}]}]'),
            'inline' => true,
            'rows' => 3,
        ],
    ])->setField([
        'id' => 'title_blog6',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'title_blog6',
        'label' => trans('Section 9 Title'),
    ])->setField([
        'id' => 'deps_blog6',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'deps_blog6',
        'label' => trans('Section 9 Deps'),
    ])->setField([
        'id' => 'title_partner1',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'title_partner1',
        'label' => trans('Section 10 Title'),
        'attr' => [
            'placeholder' => trans('Title'),
        ]
    ])->setField([
        'id' => 'deps_partner1',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'deps_partner1',
        'label' => trans('Section 10 Deps'),
        'attr' => [
            'placeholder' => trans('Deps'),
        ]
    ])->setField([
        'id' => 'images_partner1',
        'section_id' => 'opt-sections',
        'type' => Field::TEXTAREA,
        'name' => 'images_partner1',
        'label' => trans('Section 10 Images'),
        'attr' => [
            'placeholder' => trans('[images]'),
            'inline' => true,
            'rows' => 3,
        ],
    ])->setField([
        'id' => 'title_contact1',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'title_contact1',
        'label' => trans('Section 11 Title'),
    ])->setField([
        'id' => 'deps_contact1',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'deps_contact1',
        'label' => trans('Section 11.2 Deps'),
    ]);
});

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
        'id' => 'phone',
        'section_id' => 'opt-general',
        'type' => Field::TEXT,
        'name' => 'phone',
        'label' => trans('Hotline'),
        'attr' => [
            'placeholder' => trans('Phone Number'),
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
            'placeholder' => trans('["sec1","sec4","sec5","sec6","sec7","sec9","sec11","sec12","sec13"]'),
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
        'id' => 'link_banner1',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'link_banner1',
        'label' => trans('Section 2 Link'),
        'attr' => [
            'placeholder' => trans('Link'),
        ]
    ])->setField([
        'id' => 'banner1',
        'section_id' => 'opt-sections',
        'type' => Field::MEDIA_IMAGE,
        'name' => 'banner1',
        'label' => trans('Section 2 Banner'),
        'attr' => [
            'placeholder' => trans('Image'),
        ]
    ])->setField([
        'id' => 'blog1',
        'section_id' => 'opt-sections',
        'type' => Field::SELECT,
        'name' => 'blog1',
        'label' => trans('Section 4'),
        'choices'    => $blog_categories
    ])->setField([
        'id' => 'blog_slide3',
        'section_id' => 'opt-sections',
        'type' => Field::SELECT,
        'name' => 'blog_slide3',
        'label' => trans('Section 5'),
        'choices'    => $blog_categories
    ])->setField([
        'id' => 'blog2',
        'section_id' => 'opt-sections',
        'type' => Field::SELECT,
        'name' => 'blog2',
        'label' => trans('Section 6'),
        'choices'    => $blog_categories
    ])->setField([
        'id' => 'blog3',
        'section_id' => 'opt-sections',
        'type' => Field::SELECT,
        'name' => 'blog3',
        'label' => trans('Section 7'),
        'choices'    => $blog_categories
    ])->setField([
        'id' => 'link_banner2',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'link_banner2',
        'label' => trans('Section 8 Link'),
        'attr' => [
            'placeholder' => trans('Link'),
        ]
    ])->setField([
        'id' => 'banner2',
        'section_id' => 'opt-sections',
        'type' => Field::MEDIA_IMAGE,
        'name' => 'banner2',
        'label' => trans('Section 8 Banner'),
        'attr' => [
            'placeholder' => trans('Image'),
        ]
    ])->setField([
        'id' => 'blog4',
        'section_id' => 'opt-sections',
        'type' => Field::SELECT,
        'name' => 'blog4',
        'label' => trans('Section 9'),
        'choices'    => $blog_categories
    ])->setField([
        'id' => 'blog4_2',
        'section_id' => 'opt-sections',
        'type' => Field::SELECT,
        'name' => 'blog4_2',
        'label' => trans('Section 9.2'),
        'choices'    => $blog_categories
    ])->setField([
        'id' => 'link_banner_blog_4',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'link_banner_blog_4',
        'label' => trans('Section 9 Link'),
        'attr' => [
            'placeholder' => trans('Link'),
        ]
    ])->setField([
        'id' => 'banner_blog_4',
        'section_id' => 'opt-sections',
        'type' => Field::MEDIA_IMAGE,
        'name' => 'banner_blog_4',
        'label' => trans('Section 9 Banner'),
        'attr' => [
            'placeholder' => trans('Banner'),
        ]
    ])->setField([
        'id' => 'link_banner_blog_4_2',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'link_banner_blog_4_2',
        'label' => trans('Section 9.2 Link'),
        'attr' => [
            'placeholder' => trans('Link'),
        ]
    ])->setField([
        'id' => 'banner_blog_4_2',
        'section_id' => 'opt-sections',
        'type' => Field::MEDIA_IMAGE,
        'name' => 'banner_blog_4_2',
        'label' => trans('Section 9.2 Banner'),
        'attr' => [
            'placeholder' => trans('Banner'),
        ]
    ])->setField([
        'id' => 'link_banner3',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'link_banner3',
        'label' => trans('Section 10 Link'),
        'attr' => [
            'placeholder' => trans('Link'),
        ]
    ])->setField([
        'id' => 'banner3',
        'section_id' => 'opt-sections',
        'type' => Field::MEDIA_IMAGE,
        'name' => 'banner3',
        'label' => trans('Section 10 Banner'),
        'attr' => [
            'placeholder' => trans('Image'),
        ]
    ])->setField([
        'id' => 'blog5',
        'section_id' => 'opt-sections',
        'type' => Field::SELECT,
        'name' => 'blog5',
        'label' => trans('Section 11'),
        'choices'    => $blog_categories
    ])->setField([
        'id' => 'blog5_2',
        'section_id' => 'opt-sections',
        'type' => Field::SELECT,
        'name' => 'blog5_2',
        'label' => trans('Section 11.2'),
        'choices'    => $blog_categories
    ])->setField([
        'id' => 'blog5_3',
        'section_id' => 'opt-sections',
        'type' => Field::SELECT,
        'name' => 'blog5_3',
        'label' => trans('Section 11.3'),
        'choices'    => $blog_categories
    ])->setField([
        'id' => 'title_product1',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'title_product1',
        'label' => trans('Section 12 Title'),
    ])->setField([
        'id' => 'deps_product1',
        'section_id' => 'opt-sections',
        'type' => Field::TEXT,
        'name' => 'deps_product1',
        'label' => trans('Section 12 Deps'),
    ])->setField([
        'id' => 'blog_slide4',
        'section_id' => 'opt-sections',
        'type' => Field::SELECT,
        'name' => 'blog_slide4',
        'label' => trans('Section 13'),
        'choices'    => $blog_categories
    ]);
});

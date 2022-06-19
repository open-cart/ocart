<?php
//use \Illuminate\Routing\Events\RouteMatched;
//use \Illuminate\Support\Facades\Event;
//use Ocart\Core\Forms\Field;
//
//Event::listen(RouteMatched::class, function () {
//    $blog_categories = [];
//    function dequy($n, &$arr = [], $level = ''){
//        foreach ($n as $item){
//            $arr[$item->id] = $level . $item->name;
//
//            if ($item->child_cats->count()){
//                dequy($item->child_cats, $arr, $level . '---');
//            }
//        }
//    }
//    dequy(get_blog_categories(), $blog_categories);
//
//    $blog_categories = [0 => 'None'] + $blog_categories;
//    theme_options()->setField([
//        'id' => 'domain_web',
//        'section_id' => 'opt-general',
//        'type' => Field::TEXT,
//        'name' => 'domain_web',
//        'label' => trans('Domain Web'),
//        'attr' => [
//            'placeholder' => trans('Domain Web'),
//        ]
//    ])->setField([
//        'id' => 'meta_header',
//        'section_id' => 'opt-general',
//        'type' => Field::TEXTAREA,
//        'name' => 'meta_header',
//        'label' => trans('Meta Header'),
//        'attr' => [
//            'placeholder' => trans('Code'),
//            'inline' => true,
//            'rows' => 3,
//        ]
//    ])->setField([
//        'id' => 'meta_footer',
//        'section_id' => 'opt-general',
//        'type' => Field::TEXTAREA,
//        'name' => 'meta_footer',
//        'label' => trans('Meta Footer'),
//        'attr' => [
//            'placeholder' => trans('Code'),
//            'inline' => true,
//            'rows' => 3,
//        ]
//    ])->setField([
//        'id' => 'style_custom',
//        'section_id' => 'opt-general',
//        'type' => Field::TEXTAREA,
//        'name' => 'style_custom',
//        'label' => trans('Css Custom'),
//        'attr' => [
//            'placeholder' => trans('Code Css'),
//            'inline' => true,
//            'rows' => 3,
//        ]
//    ])->setField([
//        'id' => 'address1',
//        'section_id' => 'opt-general',
//        'type' => Field::TEXT,
//        'name' => 'address1',
//        'label' => trans('Address') . ' 1',
//        'attr' => [
//            'placeholder' => trans('Address') . ' 2',
//        ]
//    ])->setField([
//        'id' => 'address2',
//        'section_id' => 'opt-general',
//        'type' => Field::TEXT,
//        'name' => 'address2',
//        'label' => trans('Address') . ' 2',
//        'attr' => [
//            'placeholder' => trans('Address') . ' 2',
//        ]
//    ])->setField([
//        'id' => 'phone1',
//        'section_id' => 'opt-general',
//        'type' => Field::TEXT,
//        'name' => 'phone1',
//        'label' => trans('Hotline 1'),
//        'attr' => [
//            'placeholder' => trans('Phone 1 Number'),
//        ]
//    ])->setField([
//        'id' => 'phone2',
//        'section_id' => 'opt-general',
//        'type' => Field::TEXT,
//        'name' => 'phone2',
//        'label' => trans('Hotline 2'),
//        'attr' => [
//            'placeholder' => trans('Phone 2 Number'),
//        ]
//    ])->setField([
//        'id' => 'email',
//        'section_id' => 'opt-general',
//        'type' => Field::TEXT,
//        'name' => 'email',
//        'label' => trans('Email'),
//        'attr' => [
//            'placeholder' => trans('Email'),
//        ]
//    ])->setField([
//        'id' => 'chat_zalo',
//        'section_id' => 'opt-general',
//        'type' => Field::TEXT,
//        'name' => 'chat_zalo',
//        'label' => trans('Chat Zalo'),
//        'attr' => [
//            'placeholder' => trans('Chat Zalo'),
//        ]
//    ])->setField([
//        'id' => 'chat_facebook',
//        'section_id' => 'opt-general',
//        'type' => Field::TEXT,
//        'name' => 'chat_facebook',
//        'label' => trans('Chat Facebook'),
//        'attr' => [
//            'placeholder' => trans('Chat Facebook'),
//        ]
//    ])->setField([
//        'id' => 'link_contact',
//        'section_id' => 'opt-general',
//        'type' => Field::TEXT,
//        'name' => 'link_contact',
//        'label' => trans('Link Contact'),
//        'attr' => [
//            'placeholder' => trans('Link Contact'),
//        ]
//    ])->setField([
//        'id' => 'section_list',
//        'section_id' => 'opt-sections',
//        'type' => Field::TEXT,
//        'name' => 'section_list',
//        'label' => trans('Section List'),
//        'attr' => [
//            'placeholder' => trans('["sec1","sec4","sec5","sec6","sec7","sec9","sec11","sec12"]'),
//        ]
//    ])->setField([
//        'id' => 'link_slide1',
//        'section_id' => 'opt-sections',
//        'type' => Field::TEXT,
//        'name' => 'link_slide1',
//        'label' => trans('Section 1 Link'),
//        'attr' => [
//            'placeholder' => trans('Link'),
//        ]
//    ])->setField([
//        'id' => 'slide1',
//        'section_id' => 'opt-sections',
//        'type' => Field::MEDIA_IMAGE,
//        'name' => 'slide1',
//        'label' => trans('Section 1 Slide'),
//        'attr' => [
//            'placeholder' => trans('Image'),
//        ]
//    ])->setField([
//        'id' => 'slide1_mobile',
//        'section_id' => 'opt-sections',
//        'type' => Field::MEDIA_IMAGE,
//        'name' => 'slide1_mobile',
//        'label' => trans('Section 1 Slide Mobile'),
//        'attr' => [
//            'placeholder' => trans('Image'),
//        ]
//    ])->setField([
//        'id' => 'link_slide1_2',
//        'section_id' => 'opt-sections',
//        'type' => Field::TEXT,
//        'name' => 'link_slide1_2',
//        'label' => trans('Section 1.2 Link'),
//        'attr' => [
//            'placeholder' => trans('Link'),
//        ]
//    ])->setField([
//        'id' => 'slide1_2',
//        'section_id' => 'opt-sections',
//        'type' => Field::MEDIA_IMAGE,
//        'name' => 'slide1_2',
//        'label' => trans('Section 1.2 Slide'),
//        'attr' => [
//            'placeholder' => trans('Image'),
//        ]
//    ])->setField([
//        'id' => 'slide1_2_mobile',
//        'section_id' => 'opt-sections',
//        'type' => Field::MEDIA_IMAGE,
//        'name' => 'slide1_2_mobile',
//        'label' => trans('Section 1.2 Slide Mobile'),
//        'attr' => [
//            'placeholder' => trans('Image'),
//        ]
//    ])->setField([
//        'id' => 'link_slide1_3',
//        'section_id' => 'opt-sections',
//        'type' => Field::TEXT,
//        'name' => 'link_slide1_3',
//        'label' => trans('Section 1.3 Link'),
//        'attr' => [
//            'placeholder' => trans('Link'),
//        ]
//    ])->setField([
//        'id' => 'slide1_3',
//        'section_id' => 'opt-sections',
//        'type' => Field::MEDIA_IMAGE,
//        'name' => 'slide1_3',
//        'label' => trans('Section 1.3 Slide'),
//        'attr' => [
//            'placeholder' => trans('Image'),
//        ]
//    ])->setField([
//        'id' => 'slide1_3_mobile',
//        'section_id' => 'opt-sections',
//        'type' => Field::MEDIA_IMAGE,
//        'name' => 'slide1_3_mobile',
//        'label' => trans('Section 1.3 Slide Mobile'),
//        'attr' => [
//            'placeholder' => trans('Image'),
//        ]
//    ])->setField([
//        'id' => 'title_about4',
//        'section_id' => 'opt-sections',
//        'type' => Field::TEXT,
//        'name' => 'title_about4',
//        'label' => trans('Section 3 Title'),
//    ])->setField([
//        'id' => 'deps_about4',
//        'section_id' => 'opt-sections',
//        'type' => Field::EDITOR,
//        'name' => 'deps_about4',
//        'label' => trans('Section 3 Deps'),
//        'attr' => [
//            'inline' => true,
//            'rows' => 4,
//        ]
//    ])->setField([
//        'id' => 'link_about4',
//        'section_id' => 'opt-sections',
//        'type' => Field::TEXT,
//        'name' => 'link_about4',
//        'label' => trans('Section 3 Link'),
//    ])->setField([
//        'id' => 'image_about4',
//        'section_id' => 'opt-sections',
//        'type' => Field::MEDIA_IMAGE,
//        'name' => 'image_about4',
//        'label' => trans('Section 3 Image'),
//        'attr' => [
//            'placeholder' => trans('Image'),
//        ]
//    ])->setField([
//        'id' => 'title_product1',
//        'section_id' => 'opt-sections',
//        'type' => Field::TEXT,
//        'name' => 'title_product1',
//        'label' => trans('Section 4 Title'),
//    ])->setField([
//        'id' => 'deps_product1',
//        'section_id' => 'opt-sections',
//        'type' => Field::TEXT,
//        'name' => 'deps_product1',
//        'label' => trans('Section 4 Deps'),
//    ])->setField([
//        'id' => 'bg_about_5',
//        'section_id' => 'opt-sections',
//        'type' => Field::MEDIA_IMAGE,
//        'name' => 'bg_about_5',
//        'label' => trans('Section 5 Background'),
//        'attr' => [
//            'placeholder' => trans('Image'),
//        ]
//    ])->setField([
//        'id' => 'image_about5',
//        'section_id' => 'opt-sections',
//        'type' => Field::MEDIA_IMAGE,
//        'name' => 'image_about5',
//        'label' => trans('Section 5 Image'),
//        'attr' => [
//            'placeholder' => trans('Image'),
//        ]
//    ])->setField([
//        'id' => 'title_about5',
//        'section_id' => 'opt-sections',
//        'type' => Field::TEXT,
//        'name' => 'title_about5',
//        'label' => trans('Section 5 Title'),
//    ])->setField([
//        'id' => 'deps_about5',
//        'section_id' => 'opt-sections',
//        'type' => Field::TEXT,
//        'name' => 'deps_about5',
//        'label' => trans('Section 5 Deps'),
//    ])->setField([
//        'id' => 'phone_about5',
//        'section_id' => 'opt-sections',
//        'type' => Field::TEXT,
//        'name' => 'phone_about5',
//        'label' => trans('Section 5 Phone'),
//    ])->setField([
//        'id' => 'zalo_about5',
//        'section_id' => 'opt-sections',
//        'type' => Field::TEXT,
//        'name' => 'zalo_about5',
//        'label' => trans('Section 5 Zalo'),
//    ])->setField([
//        'id' => 'facebook_about5',
//        'section_id' => 'opt-sections',
//        'type' => Field::TEXT,
//        'name' => 'facebook_about5',
//        'label' => trans('Section 5 Facebook'),
//    ])->setField([
//        'id' => 'image_about5_2',
//        'section_id' => 'opt-sections',
//        'type' => Field::MEDIA_IMAGE,
//        'name' => 'image_about5_2',
//        'label' => trans('Section 5_2 Image'),
//        'attr' => [
//            'placeholder' => trans('Image'),
//        ]
//    ])->setField([
//        'id' => 'title_about5_2',
//        'section_id' => 'opt-sections',
//        'type' => Field::TEXT,
//        'name' => 'title_about5_2',
//        'label' => trans('Section 5_2 Title'),
//    ])->setField([
//        'id' => 'deps_about5_2',
//        'section_id' => 'opt-sections',
//        'type' => Field::TEXT,
//        'name' => 'deps_about5_2',
//        'label' => trans('Section 5_2 Deps'),
//    ])->setField([
//        'id' => 'phone_about5_2',
//        'section_id' => 'opt-sections',
//        'type' => Field::TEXT,
//        'name' => 'phone_about5_2',
//        'label' => trans('Section 5_2 Phone'),
//    ])->setField([
//        'id' => 'zalo_about5_2',
//        'section_id' => 'opt-sections',
//        'type' => Field::TEXT,
//        'name' => 'zalo_about5_2',
//        'label' => trans('Section 5_2 Zalo'),
//    ])->setField([
//        'id' => 'facebook_about5_2',
//        'section_id' => 'opt-sections',
//        'type' => Field::TEXT,
//        'name' => 'facebook_about5_2',
//        'label' => trans('Section 5_2 Facebook'),
//    ])->setField([
//        'id' => 'title_blog7',
//        'section_id' => 'opt-sections',
//        'type' => Field::TEXT,
//        'name' => 'title_blog7',
//        'label' => trans('Section 6 Title'),
//    ])->setField([
//        'id' => 'deps_blog7',
//        'section_id' => 'opt-sections',
//        'type' => Field::TEXT,
//        'name' => 'deps_blog7',
//        'label' => trans('Section 6 Deps'),
//    ])->setField([
//        'id' => 'title_blog8',
//        'section_id' => 'opt-sections',
//        'type' => Field::TEXT,
//        'name' => 'title_blog8',
//        'label' => trans('Section 7 Title'),
//    ])->setField([
//        'id' => 'deps_blog8',
//        'section_id' => 'opt-sections',
//        'type' => Field::TEXT,
//        'name' => 'deps_blog8',
//        'label' => trans('Section 7 Deps'),
//    ])->setField([
//        'id' => 'deps_contact1',
//        'section_id' => 'opt-sections',
//        'type' => Field::TEXT,
//        'name' => 'deps_contact1',
//        'label' => trans('Section 8 Deps'),
//    ]);
//});

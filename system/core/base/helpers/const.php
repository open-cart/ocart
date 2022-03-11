<?php

define('ADMIN_PREFIX', config('const.ADMIN_PREFIX', 'admin'));
define('ADMIN_MIDDLEWARE', config('const.ADMIN_MIDDLEWARE', ['web', 'auth:admin', 'author']));

if (!defined('BASE_ACTION_PUBLIC_RENDER_SINGLE')) {
    define('BASE_ACTION_PUBLIC_RENDER_SINGLE', 'base_action_public_render_single');
}

// use to add meta box to each module
if (!defined('BASE_ACTION_META_BOXES')) {
    define('BASE_ACTION_META_BOXES', 'meta_boxes');
}

// use in get list data function in each repository
if (!defined('BASE_FILTER_GET_LIST_DATA')) {
    define('BASE_FILTER_GET_LIST_DATA', 'get_list_data');
}

if (!defined('BEFORE_QUERY_CRITERIA')) {
    define('BEFORE_QUERY_CRITERIA', 'criteria_before_query');
}

if (!defined('BASE_FILTER_TABLE_BUTTONS')) {
    define('BASE_FILTER_TABLE_BUTTONS', 'base_filter_datatables_buttons');
}

if (!defined('BASE_FILTER_BEFORE_RENDER_FORM')) {
    define('BASE_FILTER_BEFORE_RENDER_FORM', 'base_filter_before_render_form');
}

if (!defined('BASE_FILTER_PUBLIC_SINGLE_DATA')) {
    define('BASE_FILTER_PUBLIC_SINGLE_DATA', 'filter_public_single_data');
}

if (!defined('FILTER_SLUG_PREFIX')) {
    define('FILTER_SLUG_PREFIX', 'slug-prefix-filter');
}

if (!defined('BASE_FILTER_TABLE_QUERY')) {
    define('BASE_FILTER_TABLE_QUERY', 'BASE_FILTER_TABLE_QUERY');
}

if (!defined('BASE_FILTER_ENUM_ARRAY')) {
    define('BASE_FILTER_ENUM_ARRAY', 'BASE_FILTER_ENUM_ARRAY');
}

if (!defined('BASE_FILTER_TOP_HEADER_LAYOUT')) {
    define('BASE_FILTER_TOP_HEADER_LAYOUT', 'base_filter_top_header_layout');
}

if (!defined('BASE_FILTER_EMAIL_TEMPLATE_HEADER')) {
    define('BASE_FILTER_EMAIL_TEMPLATE_HEADER', 'base_filter_email_template_header');
}

if (!defined('BASE_FILTER_EMAIL_TEMPLATE_FOOTER')) {
    define('BASE_FILTER_EMAIL_TEMPLATE_FOOTER', 'base_filter_email_template_footer');
}


if (!defined('BASE_FILTER_EMAIL_TEMPLATE')) {
    define('BASE_FILTER_EMAIL_TEMPLATE', 'base_filter_email_template');
}
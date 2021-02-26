<?php

define('ADMIN_PREFIX', config('const.ADMIN_PREFIX', 'admin'));
define('ADMIN_MIDDLEWARE', config('const.ADMIN_MIDDLEWARE', ['web', 'auth']));

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

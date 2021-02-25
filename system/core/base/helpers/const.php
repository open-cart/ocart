<?php

define('ADMIN_PREFIX', config('const.ADMIN_PREFIX', 'admin'));
define('ADMIN_MIDDLEWARE', config('const.ADMIN_MIDDLEWARE', ['web']));

if (!defined('BASE_ACTION_PUBLIC_RENDER_SINGLE')) {
    define('BASE_ACTION_PUBLIC_RENDER_SINGLE', 'base_action_public_render_single');
}

// use to add meta box to each module
if (!defined('BASE_ACTION_META_BOXES')) {
    define('BASE_ACTION_META_BOXES', 'meta_boxes');
}

<?php

define('ADMIN_PREFIX', config('const.ADMIN_PREFIX', 'admin'));
define('ADMIN_MIDDLEWARE', config('const.ADMIN_MIDDLEWARE', ['web']));

if (!defined('BASE_ACTION_PUBLIC_RENDER_SINGLE')) {
    define('BASE_ACTION_PUBLIC_RENDER_SINGLE', 'base_action_public_render_single');
}

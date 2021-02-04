<?php

function oc_trans($key = null, $replace = [], $locale = null) {
    if (is_null($key)) {
        return app('translator');
    }
    if (app('translator')->has('blog.'.$key)) {
        return app('translator')->get('blog.'.$key, $replace, $locale);
    }

    return app('translator')->get('Plugins/Blog::'.$key, $replace, $locale);
}

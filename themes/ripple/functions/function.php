<?php

\Ocart\Page\Supports\Template::registerTemplate([
    'guest' => 'Guest'
]);

if (is_active_plugin('contact')) {
    add_filter(CONTACT_FORM_TEMPLATE_VIEW, function () {
        return 'theme::shortcodes.contact-form';
    });
}
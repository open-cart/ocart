<?php

\Ocart\Page\Supports\Template::registerTemplate([
    'slide' => 'Slide',
    'guest' => 'Guest',
]);

TnMedia::addSize('medium', '400', '400');
TnMedia::addSize('large', '850', '850');

if (is_active_plugin('contact')) {
    add_filter(CONTACT_FORM_TEMPLATE_VIEW, function () {
        return 'theme::shortcodes.contact-form';
    });
}

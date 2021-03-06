<?php

namespace Ocart\Core\Facades;

use Illuminate\Support\Facades\Facade;

/**
 *
 * @method static \Ocart\Core\Supports\EmailHandler preview()
 * @method static \Ocart\Core\Supports\EmailHandler module(string $name)
 * @method static void sendUsingTemplate(string $template, $data = [])
 * @method static void addTemplateSettings(string $module, $data = [])
 *
 * @see \Ocart\Core\Supports\EmailHandler
 */
class EmailHandler extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Ocart\Core\Supports\EmailHandler::class;
    }
}
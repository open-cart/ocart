<?php
namespace Ocart\Core\Library;


use Illuminate\Support\Facades\File;

class Helper
{
    /**
     * Load module's helpers
     * @param $directory
     *
     * @since 2.0
     */
    public static function autoload($directory)
    {
        $helpers = File::glob($directory . '/*.php');
        foreach ($helpers as $helper) {
            File::requireOnce($helper);
        }
    }

    public static function countries()
    {
        return config('core.base.general.countries', []);
    }
}

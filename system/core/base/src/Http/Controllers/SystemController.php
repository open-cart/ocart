<?php

namespace Ocart\Core\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;
use Ocart\Core\Http\Responses\BaseHttpResponse;

class SystemController extends BaseController
{
    /**
     * @return Factory|View
     */
    public function getCacheManagement()
    {
        page_title()->setTitle(trans('core/base::cache.cache_management'));

//        Assets::addScriptsDirectly('vendor/core/core/base/js/cache.js');

        return view('core::system.cache');
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @param Filesystem $files
     * @param Application $app
     * @return BaseHttpResponse
     */
    public function postClearCache(Request $request, BaseHttpResponse $response, Filesystem $files, Application $app)
    {
        switch ($request->input('type')) {
            case 'clear_cms_cache':
//                Helper::clearCache();
//                Menu::clearCacheMenuItems();
                Cache::flush();
                \Appstract\Opcache\OpcacheFacade::clear();
//                if (File::isDirectory(storage_path('framework/cache/data'))) {
//                    foreach (File::allFiles(storage_path('logs')) as $file) {
//                        File::delete($file->getPathname());
//                    }
//                }
                break;
            case 'clear_image_cache':
                if (File::isDirectory(storage_path('framework/cache/images'))) {
                    File::deleteDirectory(storage_path('framework/cache/images'));
                }
                break;
            case 'refresh_compiled_views':
                foreach ($files->glob(config('view.compiled') . '/*') as $view) {
                    $files->delete($view);
                }
                break;
            case 'clear_config_cache':
                $files->delete($app->getCachedConfigPath());
                break;
            case 'clear_route_cache':
                $files->delete($app->getCachedRoutesPath());
                break;
            case 'clear_log':
                if (File::isDirectory(storage_path('logs'))) {
                    foreach (File::allFiles(storage_path('logs')) as $file) {
                        File::delete($file->getPathname());
                    }
                }
                break;
        }

        return $response->setMessage(trans('core/base::cache.commands.' . $request->input('type') . '.success_msg'));
    }

    public function getInformation()
    {
        page_title()->setTitle(trans('core/base::system.system_information'));

        $serverEnv = [
            'version'                  => phpversion(),
            'server_software'          => \Illuminate\Support\Facades\Request::server('SERVER_SOFTWARE'),
            'server_os'                => function_exists('php_uname') ? php_uname() : 'N/A',
            'database_connection_name' => config('database.default'),
            'ssl_installed'            => !empty(\Illuminate\Support\Facades\Request::server('HTTPS')) && \Illuminate\Support\Facades\Request::server('HTTPS') != 'off',
            'cache_driver'             => config('cache.default'),
            'session_driver'           => config('session.driver'),
            'queue_connection'         => config('queue.default'),
            'mbstring_ext'                 => extension_loaded('mbstring'),
            'openssl_ext'                  => extension_loaded('openssl'),
            'curl_ext'                     => extension_loaded('curl'),
            'exif_ext'                     => extension_loaded('exif'),
            'pdo_ext'                      => extension_loaded('pdo'),
            'file_info_ext'                 => extension_loaded('fileinfo'),
            'tokenizer_ext'                => extension_loaded('tokenizer'),
            'imagick_or_gd_ext'            => extension_loaded('imagick') || extension_loaded('gd'),
        ];

        $systemEnv = [
            'app_env'              => config('app.env'),
            'cms_version'          => get_cms_version(),
            'version'              => App::version(),
            'timezone'             => config('app.timezone'),
            'debug_mode'           => config('app.debug'),
            'storage_dir_writable' => File::isWritable(base_path('storage')),
            'cache_dir_writable'   => File::isReadable(base_path('bootstrap/cache')),
            'app_size'             => human_file_size(folder_size(base_path())),
        ];

        return view('core::system.information',
            compact('serverEnv', 'systemEnv'));
    }
}
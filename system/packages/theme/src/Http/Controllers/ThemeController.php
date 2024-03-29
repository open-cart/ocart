<?php


namespace Ocart\Theme\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Ocart\Core\Events\UpdatedContentEvent;
use Ocart\Core\Http\Controllers\BaseController;
use Ocart\Core\Http\Responses\BaseHttpResponse;
use Ocart\Setting\Facades\Setting;
use Ocart\Theme\Facades\ThemeOption;

class ThemeController extends BaseController
{
    protected $files;

    public function __construct(\Illuminate\Filesystem\Filesystem $files)
    {
        $this->files = $files;
    }

    public function index()
    {
        $this->authorize('themes.index');

        $list = [];

        $themes = array_filter(glob(theme_path('*')), 'is_dir');

        if (!empty($themes)) {
            foreach ($themes as $themePath) {

                if (!File::isDirectory($themePath) || !File::exists($themePath . '/theme.json')) {
                    continue;
                }

                $content = get_file_data($themePath . '/theme.json');

                if (!empty($content)) {
                    $content['active'] = false;
                    if ($content['name'] === \setting('theme', 'default')) {
                        $content['active'] = true;
                        if (env('CHECK_UPDATE_THEME') == true) {
                            $client = new \GuzzleHttp\Client();
                            $uriDefault = 'http://171.244.23.101:8001/theme';
                            $uri = env('URL_CHECK_THEME', $uriDefault) . '?name=' . $content['name'];
                            $res = $client->request('GET', $uri) ;
                            $con = json_decode($res->getBody()->getContents(), true);
                            $reference = setting('theme_'.$content['name'].'reference');
                            if ($reference != Arr::get($con, 'reference')) {
                                $content['update'] = true;
                            }
                            $content['reference'] = Arr::get($con, 'reference');
                        }
                    }

                    $folder = Arr::last(explode(DIRECTORY_SEPARATOR, $themePath));

                    $list[$folder] = $content;
                }
            }
        }

        return view('packages.theme::index')
            ->with('themes', $list);
    }

    public function getOptions()
    {
        page_title()->setTitle(trans('packages/theme::theme.theme_options'));
        return view('packages.theme::options');
    }

    public function postOptions(Request $request, BaseHttpResponse $response)
    {
        foreach ($request->except(['_token', 'ref_lang']) as $key => $value) {
            if (is_array($value)) {
                $value = json_encode($value);

//                $field = ThemeOption::getField($key);

//                if ($field && Arr::get($field, 'clean_tags', true)) {
//                    $value = clean(strip_tags($value));
//                }
            }

            ThemeOption::setOption($key, $value);
        }

        ThemeOption::saveOptions();

        return $response->setMessage(trans('core/base::notices.update_success_message'));
    }

    public function postActivateTheme(Request $request, BaseHttpResponse $response)
    {
        try {
            Gate::forUser(Auth::user())
                ->authorize('themes.activate');
        } catch(\Exception $e) {
            Session::flash('message', $e->getMessage());
            return $response->setError()->setMessage($e->getMessage());
        }

        $theme = $request->input('theme');

        Setting::set('theme', $theme)->save();

        $resourcePath = $this->getPath('public', $theme);

        $publishPath = public_path('themes/' . $theme);

        if (!$this->files->isDirectory($publishPath)) {
            $this->files->makeDirectory($publishPath, 0755, true);
        }

        $this->files->copyDirectory($resourcePath, $publishPath);
        $this->files->copy($this->getPath('screenshot.png', $theme), $publishPath . '/screenshot.png');

        event(new UpdatedContentEvent(SYSTEM_MODULE_THEME_ACTIVE_SCREEN_NAME, $request, $theme));

        return $response->setMessage(trans('Activated theme successfully'));
    }

    public function postUpdateTheme(Request $request, BaseHttpResponse $response)
    {
        $theme = $request->input('theme');
        $reference = $request->input('reference');

        shell_exec(env('PATH_SHELL_UPDATE_THEME')." " . theme_path($theme) . " " . $reference ." 2>&1");

        setting()->set('theme_'.$theme.'reference', $reference)->save();

        $resourcePath = $this->getPath('public', $theme);

        $publishPath = public_path('themes/' . $theme);

        if (!$this->files->isDirectory($publishPath)) {
            $this->files->makeDirectory($publishPath, 0755, true);
        }

        $this->files->copyDirectory($resourcePath, $publishPath);
        $this->files->copy($this->getPath('screenshot.png', $theme), $publishPath . '/screenshot.png');

        event(new UpdatedContentEvent(SYSTEM_MODULE_THEME_UPDATE_SCREEN_NAME, $request, $theme));

        return $response->setMessage(trans('update theme successfully'));
    }

    protected function getPath($name, $theme)
    {
        return theme_path($theme . DIRECTORY_SEPARATOR . $name);
    }

}

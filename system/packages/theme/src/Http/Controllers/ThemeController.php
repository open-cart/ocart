<?php


namespace Ocart\Theme\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Ocart\Core\Http\Controllers\BaseController;
use Ocart\Setting\Facades\Setting;

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
                    $content->active = false;
                    if ($content->name === \setting('theme', 'default')) {
                        $content->active = true;
                    }

                    $folder = Arr::last(explode(DIRECTORY_SEPARATOR, $themePath));

                    $list[$folder] = $content;
                }
            }
        }

        return view('packages.theme::index')
            ->with('themes', $list);
    }

    public function postActivateTheme(Request $request)
    {
        try {
            Gate::forUser(Auth::user())
                ->authorize('themes.activate');
        } catch(\Exception $e) {
            Session::flash('message', $e->getMessage());
            return response()->json(['error' => 1, 'msg' => $e->getMessage()]);
        }

        $theme = $request->input('theme');

        Setting::set('theme', $theme)->save();

//        (new AdminConfig)->where('key', 'theme')->update(['value' => $theme]);

        $resourcePath = $this->getPath('public', $theme);

        $publishPath = public_path('themes/' . $theme);

        if (!$this->files->isDirectory($publishPath)) {
            $this->files->makeDirectory($publishPath, 0755, true);
        }

        $this->files->copyDirectory($resourcePath, $publishPath);
        $this->files->copy($this->getPath('screenshot.png', $theme), $publishPath . '/screenshot.png');

        return response()->json(['error' => 0, 'msg' => '']);
    }

    protected function getPath($name, $theme)
    {
        return theme_path($theme . DIRECTORY_SEPARATOR . $name);
    }

}

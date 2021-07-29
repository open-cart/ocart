<?php
namespace Ocart\Dashboard\Http\Controllers;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Ocart\Core\Http\Controllers\BaseController;
use Ocart\Dashboard\Repositories\DashboardWidgetRepository;
use Ocart\Dashboard\Repositories\DashboardWidgetSettingRepository;

class DashboardController extends BaseController
{
    protected $widgetRepository;

    protected $widgetSettingRepository;

    public function __construct(
        DashboardWidgetRepository $dashboardWidgetRepository,
        DashboardWidgetSettingRepository $dashboardWidgetSettingRepository
    )
    {
        $this->widgetRepository = $dashboardWidgetRepository;
        $this->widgetSettingRepository = $dashboardWidgetSettingRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        \Assets::addScriptsDirectly([
            'vendor/core/dashboard/js/dashboard.js'
        ]);

        $widgets = $this->widgetRepository->with([
            'settings' => function(HasMany $query) use ($request) {
                return $query->where('user_id', $request->user()->getKey())
                    ->select(['status', 'order', 'settings', 'widget_id'])
                    ->orderBy('order');
            }
        ])->all(['id', 'name']);

        $widgetData = apply_filters(DASHBOARD_FILTER_ADMIN_LIST, [], $widgets);
        ksort($widgetData);

        $user_widgets = collect($widgetData)->pluck('view')->all();

        return view('core.dashboard::list', compact('user_widgets'));
    }
}
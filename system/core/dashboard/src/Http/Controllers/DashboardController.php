<?php
namespace Ocart\Dashboard\Http\Controllers;

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

    public function index()
    {
        $widgets = $this->widgetRepository->all();

        $widgetData = apply_filters(DASHBOARD_FILTER_ADMIN_LIST, [], $widgets);

        $user_widgets = collect($widgetData)->pluck('view')->all();

        return view('core.dashboard::list', compact('user_widgets'));
    }
}
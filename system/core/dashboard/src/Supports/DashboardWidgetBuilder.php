<?php

namespace Ocart\Dashboard\Supports;

use Ocart\Dashboard\Repositories\DashboardWidgetRepository;

class DashboardWidgetBuilder
{
    /**
     * @var string
     */
    public $key;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $icon;

    /**
     * @var AbstractDashboardWidget
     */
    protected $widget;

    protected $options = [];

    public function __construct()
    {
        $this->create(BaseWidget::class);
    }

    public function create($class, $options = array())
    {
        $widget = app()->make($class);
        $this->setOptions($options);

        $this->widget = $widget;
        return $this;
    }

    /**
     * @param mixed $type
     */
    public function useStatsWidget()
    {
        $this->create(StatsWidget::class);
        return $this;
    }

    /**
     * @param $instance
     * @param array $options
     * @return mixed
     */
    public function setDependenciesAndOptions(DashboardWidget $instance, $options = array())
    {
        return $instance
            ->setIcon($this->icon)
            ->setTitle($this->title)
            ->setOptions($options)
            ->setKey($this->key);
    }

    /**
     * @param array $options
     * @return $this
     */
    public function setOptions($options = [])
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @param string $key
     * @return DashboardWidgetBuilder
     */
    public function setKey(string $key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @param string $title
     * @return DashboardWidgetBuilder
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param string $icon
     * @return DashboardWidgetBuilder
     */
    public function setIcon(string $icon)
    {
        $this->icon = $icon;
        return $this;
    }

    public function setUpWidget()
    {
        $widget = $this->setDependenciesAndOptions($this->widget, $this->options);
        $widget->buildWidget();
    }

    public function init($widgets, $settings) {
        $this->setUpWidget();

        $widget = $settings->where('name', $this->key)->first();
        $widgetSetting = $widget ? $widget->settings->first() : null;

        if (!$widget) {
            $widget = app(DashboardWidgetRepository::class)
                ->create(['name' => $this->key]);
        }

        if ($widgetSetting && $widgetSetting->status != 1) {
            return $widgets;
        }

        $this->widget->setSetting($widgetSetting);

        $data = [
            'id' => $this->key,
            'view' => $this->widget->render(),
        ];

        if (empty($widgetSetting) || array_key_exists($widgetSetting->order, $widgets)) {
            $widgets[] = $data;
        } else {
            $widgets[$widgetSetting->order] = $data;
        }

        return $widgets;

//        $widgets[$this->key] = [
//            'id' => $this->key,
//            'view' => $this->widget->render(),
//        ];
//
//        return $widgets;
    }
}
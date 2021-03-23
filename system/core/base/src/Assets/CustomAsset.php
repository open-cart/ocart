<?php
namespace Ocart\Core\Assets;

use Botble\Assets\Assets;
use Illuminate\Support\Arr;

class CustomAsset extends Assets
{
    const ASSETS_SCRIPT_POSITION_BODY = 'body';

    /**
     * Get All CSS in current module.
     *
     * @param array $lastStyles Append last CSS to current module
     * @return array
     */
    public function getStyles($location = null)
    {
        $styles = [];

        $this->styles = array_unique($this->styles);

        foreach ($this->styles as $style) {
            $configName = 'resources.styles.' . $style;

            if (!empty($location) && $location !== Arr::get($this->config, $configName . '.location')) {
                continue; // Skip assets that don't match this location
            }

            $styles = array_merge($styles, $this->getSource($configName));
        }


        return array_merge($styles, Arr::get($this->appendedStyles, $location, []));
    }

    /**
     * Render assets to footer.
     *
     * @return string
     * @throws \Throwable
     */
    public function renderBody()
    {
        $styles = $this->getStyles(self::ASSETS_SCRIPT_POSITION_BODY);

        $headScripts = $this->getScripts(self::ASSETS_SCRIPT_POSITION_BODY);

        return view('assets::header', compact('styles', 'headScripts'))->render();
    }

    /**
     * Render assets to header.
     *
     * @param array $lastStyles
     * @return string
     * @throws \Throwable
     */
    public function renderHeader($lastStyles = [])
    {
        $styles = $this->getStyles(self::ASSETS_SCRIPT_POSITION_HEADER);

        $headScripts = $this->getScripts(self::ASSETS_SCRIPT_POSITION_HEADER);

        return view('assets::header', compact('styles', 'headScripts'))->render();
    }

    /**
     * Render assets to footer.
     *
     * @return string
     * @throws \Throwable
     */
    public function renderFooter()
    {
        $bodyScripts = $this->getScripts(self::ASSETS_SCRIPT_POSITION_FOOTER);

        return view('assets::footer', compact('bodyScripts'))->render();
    }
}
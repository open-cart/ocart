<?php


namespace Ocart\Core\Library;

class Action extends ActionHookEvent
{
    /**
     * Filters a value
     * @param string $action Name of action
     * @param array $args Arguments passed to the filter
     */
    public function fire($action, $args)
    {
        if (!$this->getListeners($action)) {
            return;
        }

        $res = [];

        foreach ($this->getListeners($action) as $arguments) {
            $parameters = [];
            for ($index = 0; $index < $arguments['arguments']; $index++) {
                if (isset($args[$index])) {
                    $parameters[] = $args[$index];
                }
            }

            $res[] = call_user_func_array($this->getFunction($arguments['callback']), $parameters);
        }

        return implode(PHP_EOL.PHP_EOL, (array) $res);
    }
}

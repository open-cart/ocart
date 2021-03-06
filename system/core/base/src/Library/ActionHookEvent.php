<?php


namespace System\Core\Library;

use Closure;

abstract class ActionHookEvent
{
    /**
     * Holds the event listeners
     * @var array
     */
    protected $listeners = [];

    /**
     * The sorted event listeners.
     *
     * @var array
     */
    protected $sorted = [];

    /**
     * Adds a listener
     * @param string $hook Hook name
     * @param mixed $callback Function to execute
     * @param integer $priority Priority of the action
     * @param integer $arguments Number of arguments to accept
     */
    public function addListener($hook, $callback, $priority = 20, $arguments = 1)
    {
        while (isset($this->listeners[$hook][$priority])) {
            $priority += 1;
        }

        $this->listeners[$hook][$priority] = compact('callback', 'arguments');
    }

    /**
     * Gets a sorted list of all listeners
     * @return array
     */
    public function getListeners($eventName)
    {
        if (! isset($this->sorted[$eventName])) {
            $this->sortListeners($eventName);
        }

        return $this->sorted[$eventName];
    }

    /**
     * Sort the listeners for a given event by priority.
     *
     * @param  string  $eventName
     * @return array
     */
    protected function sortListeners($eventName)
    {
        $this->sorted[$eventName] = [];

        // If listeners exist for the given event, we will sort them by the priority
        // so that we can call them in the correct order. We will cache off these
        // sorted event listeners so we do not have to re-sort on every events.
        if (isset($this->listeners[$eventName])) {
            uksort($this->listeners[$eventName], function ($param1, $param2) {
                return strnatcmp($param1, $param2);
            });

            $this->sorted[$eventName] = $this->listeners[$eventName];
        }
    }

    /**
     * Gets the function
     * @param mixed $callback Callback
     * @return mixed A closure, an array if "class@method" or a string if "function_name"
     */
    protected function getFunction($callback)
    {
        return get_function_callback($callback);
    }

    /**
     * Fires a new action
     * @param string $action Name of action
     * @param array $args Arguments passed to the action
     */
    abstract public function fire($action, $args);
}

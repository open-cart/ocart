<?php


namespace System\Core\Library;


class CustomResourceRegistrar extends \Illuminate\Routing\ResourceRegistrar
{
    /**
     * Add the destroy method for a resourceful routes.
     *
     * @param  string  $name
     * @param  string  $base
     * @param  string  $controller
     * @param  array  $options
     * @return \Illuminate\Routing\Route
     */
    protected function addResourceDestroy($name, $base, $controller, $options)
    {
        $name = $this->getShallowName($name, $options);

        $uri = $this->getResourceUri($name).'/destroy';

        $action = $this->getResourceAction($name, $controller, 'destroy', $options);

        return $this->router->delete($uri, $action);
    }
}

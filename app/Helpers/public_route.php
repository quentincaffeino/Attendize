<?php

if (! function_exists('public_route')) {
    /**
     * Generate the URL to a named route.
     *
     * @param  array|string  $name
     * @param  mixed  $parameters
     * @param  bool  $absolute
     * @return string
     */
    function public_route($name, $parameters = [], $absolute = true)
    {
        if (!$absolute) {
            return app('url')->route($name, $parameters, $absolute);
        }

        $route = Route::getRoutes()->getByName($name)->domain(env('PUBLIC_URL', Request::root()));
        return app('url')->toRoute($route, $parameters, true);
    }
}

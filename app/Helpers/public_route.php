<?php

declare(strict_types=1);

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

        $requestRoot = Request::root();

        // Temporary replace default app domain with public domain
        $route = Route::getRoutes()->getByName($name)->domain(env('PUBLIC_URL', $requestRoot));
        // Generate public url string
        $result = app('url')->toRoute($route, $parameters, true);
        // Set domain to default value
        $route = Route::getRoutes()->getByName($name)->domain($requestRoot);

        return $result;
    }
}

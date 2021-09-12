<?php

declare(strict_types=1);

if (!function_exists('app_url')) {
    /**
     * Generate an absolute URL to the given path.
     *
     * @param  string  $path
     * @param  mixed  $extra
     * @param  bool|null  $secure
     * @return string
     */
    function app_url($path, $extra = [], $secure = null)
    {
        $urlGenerator = app('url');
        $requestRoot = $urlGenerator->getRequest()->root();
        $appUrl = env('APP_URL', $requestRoot);

        // Temporary replace default app domain with public domain
        $urlGenerator->forceRootUrl($appUrl);
        // Generate public url string
        $result = $urlGenerator->to($path, $extra, $secure);
        // Set domain to default value
        $urlGenerator->forceRootUrl('');

        return $result;
    }
}

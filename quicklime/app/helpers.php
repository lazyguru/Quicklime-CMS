<?php

if (!function_exists('cms_path')) {
    /**
     * Get the path to cms directory
     * @staticvar string $cms_path
     * @param string $path
     * @return string
     */
    function cms_path($path = null)
    {
        $cms_path = realpath(app('path.cms'));
        return $cms_path.($path ? '/'.$path : $path);
    }
}

if (!function_exists('cms_page')) {
    /**
     * Returns the path to a specified page
     * @param string $page
     * @return string
     */
    function cms_page($page)
    {
        return cms_path("pages/$page.md");
    }
}

if (!function_exists('cms_theme')) {
    /**
     * Returns a path relative to current theme path
     * @param string $path
     * @return string
     */
    function cms_theme($path)
    {
        return cms_path('themes/'.cms('theme_name')."/$path");
    }
}

if (!function_exists('theme_config')) {
    /**
     * Return a theme configuration value
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function theme_config($key, $default = null)
    {
        return config('quicklime.theme.'.$key, $default);
    }
}

if (!function_exists('cms')) {
    /**
     * Return a Quicklime configuration value
     * @param string $option
     * @return mixed
     */
    function cms($option)
    {
        return config("quicklime.$option");
    }
}

if (!function_exists('theme_url')) {
    /**
     * Return the URL to a path in the current theme
     * @param string $path
     * @return string
     */
    function theme_url($path = null)
    {
        return str_replace(public_path(), '', cms_theme($path));
    }
}

if (!function_exists('__')) {
    /**
     * Translates a text based on its key
     * @param string $key
     * @param string $prefix
     * @return string
     */
    function __($key, $prefix = '')
    {
        $prefix = $prefix ? "quicklime::$prefix." : 'quicklime::user.';
        return Lang::has($prefix.$key) ? Lang::trans($prefix.$key) : $key;
    }
}

<?php

namespace Quicklime;

class Link
{
    /**
     * Check URL is external to our site
     * @param string $url
     * @return boolean
     */
    public static function isExternal($url)
    {
        // Only look at http and https URLs
        if (!preg_match('/^https?:\/\//', $url)) {
            return false;
        }

        $url_host = parse_url($url, PHP_URL_HOST);
        $app_host = parse_url(config('app.url'), PHP_URL_HOST);

        return $url_host != $app_host;
    }
}

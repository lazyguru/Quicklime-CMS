<?php

namespace Quicklime;

use App;
use File;
use Cache;
use Bootstrapper\Icon;
use Bootstrapper\Navigation as BsNavigation;
use Quicklime\Facades\Navigation as NavigationFacade;

class Navigation extends BsNavigation
{
    /**
     * Let's handle external links for css
     * @param array $link
     * @return string
     */
    protected function renderLink(array $link)
    {
        if (!Link::isExternal($link['link'])) {
            return parent::renderLink($link);
        }

        if (!isset($link['linkAttributes']['class'])) {
            $link['linkAttributes']['class'] = 'link-external';
        } else {
            $link['linkAttributes']['class'] .= ' link-external';
        }

        return parent::renderLink($link);
    }

    /**
     * Build the Navbar from php description file
     * @todo Don't make it depend on Bootstrap
     * @todo Use Yaml
     * @return string
     */
    public static function get()
    {
        if (cms('multilingual')) {
            $cache_key = 'navbar.'.App::getLocale();
        } else {
            $cache_key = 'navbar';
        }

        if (Cache::has($cache_key)) {
            Cache::get($cache_key);
        }

        $navbar = App::make('bootstrapper::navbar');

        if (theme_config('with_brand')) {
            $brand_image = theme_config('brand_image');

            if ($brand_image and $brand_image instanceof Icon) {
                $navbar->withBrand($brand_image, theme_config('brand_link'));
            } elseif ($brand_image) {
                $navbar->withBrandImage($brand_image, theme_config('brand_link'), theme_config('brand_title'));
            } else {
                $navbar->withBrand(theme_config('brand_title'), theme_config('brand_link'));
            }
        }

        $navigations = [
            'nav-left' => 'left',
            'nav-right' => 'right',
        ];

        $lang_path = cms('multilingual') ? App::getLocale().'/' : '';

        foreach ($navigations as $navigation => $position) {

            if (!File::exists(cms_path("menus/{$lang_path}{$navigation}.php"))) {
                continue;
            }
            $links = require cms_path("menus/{$lang_path}{$navigation}.php");

            $nav = NavigationFacade::links($links)->$position();
            $navbar->withContent($nav);
        }

        $render = $navbar->render();

        Cache::put($cache_key, $render, theme_config('cache_time', 60));

        return $render;

    }
}

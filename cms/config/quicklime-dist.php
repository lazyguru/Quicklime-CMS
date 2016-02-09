<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Site Title
    |--------------------------------------------------------------------------
    |
    | The site title is used for html title tag
    | Depending on the theme behaviour, it can be prepended to the page title
    | Default: ''
    */
    'title' => '',

     /*
     |--------------------------------------------------------------------------
     | Index page
     |--------------------------------------------------------------------------
     |
     | This is the name of the index page used when a section is accessed with
     | no page specified. Think of it like the index directive of an http server.
     | Default: 'index'
     */
     'index' => 'index',

     /*
     |--------------------------------------------------------------------------
     | Toc - Table of Contents
     |--------------------------------------------------------------------------
     |
     | If a file of that name is present in a section, it will be used as
     | a menu and, eventually, displayed in the sidebar (depending on your theme).
     | Default: 'toc'
     */
    'toc' => 'toc',

     /*
     |--------------------------------------------------------------------------
     | Multilingual
     |--------------------------------------------------------------------------
     |
     | Whether URLs are multilingual or not. When set to true, URLs are considered
     | multilingual (with a two-letter code prefix for language) and translations
     | will be loading accordingly.
     | Default: false
     */
     'multilingual' => false,

     /*
     |--------------------------------------------------------------------------
     | Redirect to Index
     |--------------------------------------------------------------------------
     |
     | When accessing a section (URL ends with a `/`), Quicklime will try to
     | display the index file, just like any web server.
     | If redirect_to_index is set to true, Quicklime will redirect instead of
     | just displaying the index.
     | Default: false
     */
    'redirect_to_index' => false,

    /*
    |--------------------------------------------------------------------------
    | Not found
    |--------------------------------------------------------------------------
    | Quicklime behaviour when resource is not found.
    | * 'error': will return a 404 HTTP response
    | * 'home': will send user to home
    | Default: 'error'
    */
    'not_found' => 'error',

    /*
    |--------------------------------------------------------------------------
    | Theme name
    |--------------------------------------------------------------------------
    |
    | Name of the theme you want to use.
    | Themes are located in `cms/themes`
    | Default: 'Quick16'
    */
    'theme_name' => 'Quick16',
];

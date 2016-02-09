# Configure theme

Quicklime comes with a very simple yet easy to use theme, named Quick16.  
Obviously you will find it in `cms/themes/` directory. The `config.php` allows you to set some specific configuration.

> Please note that every theme has its own configuration, so options may differ from one theme to another. This document only details Quick16 configuration.

Quick16 uses [Bootstrap](http://getbootstrap.com) as an HTML & CSS framework.

## Options

### `with_brand`

Adds a brand to the horizontal main mavbar. See [Bootstrap Navbar documentation](http://getbootstrap.com/components/#navbar) for more information.

### `brand_title`

Title for Brand in Navbar. If an `brand_image` is specified, `brand_title` will be used as alternative text for that image (`alt` attribute).

### `brand_image`

You may use an image for Navbar Brand. Quicklime uses Bootstrapper for Laravel, so you may also use an Icon. Example:

```
'brand_image' => Icon::home(),
// or
'brand_image' => Icon::create('home'),
```

### `brand_link`

Link on the Brand. Default is `/` so clicking on the Brand leads to homepage, which is the most common use.

### `cache_time`

Time in minutes to keep cache. Currently, cache is used to store Navbar. This was the easiest way to have different Navbars stored, since they share the same view (but the content of which may differ from one language to another in multilingual configuration).

If you need to refresh the Navbar, you may simply clear the cache. To do this, you may delete the files in `quicklime/storage/cache/` or use the command line:

```
php artisan cache:clear
```

This option is not intended to last. It's just a pitfall before Navbar generation is refactored.

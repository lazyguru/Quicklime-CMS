# Quicklime cms

Quicklime CMS is a CMS based on Laravel and using markdown files. No database, no installer, it's almost ready to use out of the box.

> ***Quicklime is currently under development. It can be subject to changes that could break a previous version. We'll take care not to do it too often and will give instructions to migrate, but we don't promise anything. Be warned!***

1. [Install](#install)
    1. [Install with git](#using-git)
    1. [Install with Composer (recommanded)](#using-composer)
    1. [Install with zip archive](#using-zip-archive)
1. [Configuration](#configuration)
    1. [Configure manually](#configure-manually)
    1. [Configure Quicklime](#configure-quicklime)
    1. [Advanced configuration (WIP)](#advanced-configuration)

## Install

You can use Composer to install Quicklime directly on your server, but you may prefer to install it on your local machine and transfer all files to your web host using (s)FTP.

### Using git

Clone the repository and install dependencies with Composer.
There is currently no package providing full Quicklime install. But it is planned.

```php
git clone -b master https://github.com/Quicklime/CMS my-project
cd my-project
composer install
```

You will have to [manually configure](#configure-manually) Quicklime and Lavarel

### Using Composer

```shell
composer create-project Quicklime/Quicklime my-project dev-master
```

You will have to [configure Quicklime](#configure-quicklime) to fit your needs

### Using zip archive

Download it at Github: https://github.com/Quicklime/Quicklime.  
Extract the archive in your public web directory then [configure Laravel manually](#configure-manually).

## Configuration

Right now, Quicklime is working. Most changes are just to fit your needs. The URL is the only really mandatory option to be configured, since all URLs may be broken if not.

### Configure manually

If you installed Quicklime using Composer, skip this step, since it's already done with post install scripts.

1. Copy `quicklime/.env.example` to `.env` and change the `APP_KEY` value. It is required to be a 32 character long string and may be completly random, it does not matter.

1. In `cms/config/` directory, copy (or rename) `app-dist.php` to `app.php` and `quicklime-dist.php` to `quicklime.php`.

1. Edit `cms/config/app.php` and set the appropriate values:
    * `url`: Url to your quicklime installation.
    * `timezone` (optional): Your timezone. See [supported timezones](http://php.net/manual/en/timezones.php) in PHP. The timezone is currently not used by Quicklime. But a theme could use it to display date/time at any moment. Default: `UTC`
    * `fallback_locale` (optional): Default locale to use. Mostly required if you plan to write content in different languages

Then [configure Quicklime](#configure-quicklime)

### Configure Quicklime

Edit `cms/config/quicklime.php` and change the values according to your needs.
The file is self documented so you don't need more documentation to adjust configuration.

### Advanced configuration

Writing in progress.

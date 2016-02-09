<?php

namespace Quicklime\Cms;

use App;
use Illuminate\Http\Request;
use Quicklime\Traits\NotFound;

class Cms
{

    use NotFound;

    /**
     * Resource identified by URL
     * @var Quicklime\Cms\Resource
     */
    protected $resource;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var string
     */
    protected $lang;

    /**
     * @var Illuminate\Http\Request
     */
    protected $request;

    /**
     * @var Illuminate\Http\RedirectResponse
     */
    protected $redirect;

    /**
     * @param Illuminate\Http\Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->parsePathInfo();
    }

    /**
     * Sets path and lang from URL
     */
    protected function parsePathInfo()
    {
        $pathInfo = $this->request->getPathInfo();

        /*
         * Single lang: nothing to do, just store the path
         */
        if (!cms('multilingual')) {
            $this->path = $this->request->getPathInfo();
            return;
        }

        /*
         * Multilingual, nothing specified, fallback to default locale
         */
        if ('/' === $pathInfo) {
            $home = $this->url(config('app.fallback_locale'));
            $this->redirect = redirect($home);
            return;
        }

        $matches = [];
        preg_match('`^/([a-z]{2})(/.*)?$`', $pathInfo, $matches);

        /*
         * What was that URL ?
         */
        if (empty($matches)) {
            $this->redirect = $this->notFound();
            return;
        }

        /*
         * Lang ok, but no path
         */
        if (!isset($matches[2])) {
            $this->redirect = redirect($this->url($matches[0].'/'));
            return;
        }

        /*
         * Ok, Lang and path are defined!
         */
        $this->lang = $matches[1];
        App::setLocale($this->lang);
        $this->path = $matches[2];
    }

    /**
     *
     * @return boolean
     */
    public function shouldRedirect()
    {
        return null !== $this->redirect;
    }

    /**
     * Returns the response where we have to redirect
     * @return Illuminate\Http\RedirectResponse
     */
    public function redirect()
    {
        return $this->redirect;
    }

    /**
     *
     * @return Quicklime\Cms\Resource
     */
    public function getResource()
    {
        if (null === $this->resource) {
            $this->resource = Resource::factory($this->path, $this->lang);
        }
        return $this->resource;
    }

    /**
     * @return string
     */
    public function path()
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function lang()
    {
        return $this->lang;
    }

    /**
     * @return string
     */
    public function fullPath()
    {
        if ($this->lang) {
            return '/'.$this->lang.$this->path;
        }

        return $this->path;
    }

    /**
     * Returns the section given path belongs to
     * @param string $path
     * @return \Quicklime\Cms\Section
     */
    public function section($path)
    {
        return new Section($path, $this->lang);
    }

    /**
     * Returns a URL and keep its trailing slash if it has one
     * @param string $path
     * @return string
     */
    public function url($path = null)
    {
        return app('config')->get('app.url') . ($path ? '/'.ltrim($path, '/') : '');
    }
}

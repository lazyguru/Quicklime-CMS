<?php

namespace Quicklime\Cms;

use File;

abstract class Resource
{

    /**
     * @var string
     */
    protected $path;

    /**
     * @var string
     */
    protected $lang;

    /**
     * Returns the appropriate resource based on url path
     * @param string $path
     * @param string $lang
     * @return \Quicklime\Cms\Toc|\Quicklime\Cms\Section|\Quicklime\Cms\Page
     */
    public static function factory($path, $lang)
    {
        if (substr($path, -1) == '/') {
            return new Section($path, $lang);
        }
        if (basename($path) == cms('toc')) {
            return new Toc($path, $lang);
        }

        return new Page($path, $lang);
    }

    /**
     * @param string $path
     * @param string $lang
     */
    public function __construct($path, $lang)
    {
        $this->path = $path;
        $this->lang = $lang;
        $this->root = cms_path();
    }

    /**
     * Returns whether the resource exists or not
     * @return boolean
     */
    public function exists()
    {
        return File::exists($this->filePath());
    }

    /**
     * Returns the path of the resource (without lang)
     * @return type
     */
    public function path()
    {
        return $this->path;
    }

    /**
     * Returns the full (url) path of the resource (with lang)
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
     * Returns the URL to the resource
     * @return string
     */
    public function url()
    {
        return app('config')->get('app.url') . $this->fullPath();
    }

    /**
     * Returns the path to the file for that resource
     * @return string
     */
    public function filePath()
    {
        return cms_path('pages'.$this->fullPath());
    }

    /**
     * Whether the resource is a page or not
     * @return boolean
     */
    public function isPage()
    {
        return get_class($this) === Page::class;
    }

    /**
     * Whether the resource is a section or not
     * @return string
     */
    public function isSection()
    {
        return get_class($this) === Section::class;
    }

    /**
     * Whether the resource is a toc or not
     * @return type
     */
    public function isToc()
    {
        return get_class($this) === Toc::class;
    }

    /**
     * Returns whether there is an index for the resource
     * @return type
     */
    public function hasIndex()
    {
        return $this->getIndex()->exists();
    }

    /**
     * Returns the type of resource
     * @return string
     */
    public function getType()
    {
        $className = strtolower(get_called_class());
        return substr($className, strrpos($className, '\\')+1);
    }
}

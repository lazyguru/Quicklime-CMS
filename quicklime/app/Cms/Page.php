<?php

namespace Quicklime\Cms;

use Illuminate\View\Factory as ViewFactory;
use Illuminate\Contracts\Support\Renderable;

class Page extends Resource implements Renderable
{

    protected $section;

    public function __construct($path = null, $lang = null)
    {
        parent::__construct($path, $lang);
        $this->section = new Section(dirname($this->path), $lang);
    }

    /**
     * Returns the path to the file for that resource
     * @return string
     */
    public function filePath()
    {
        return parent::filePath().'.md';
    }

    /**
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $factory = app(ViewFactory::class);
        return $factory->file($this->filePath());
    }

    /**
     * Return the section the page belongs to
     * @return Quicklime\Cms\Section
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * Whether the page is the index of the section
     * @return boolean
     */
    public function isIndex()
    {
        return basename($this->fullPath(), '.md') === cms('index');
    }

    /**
     * Returns the index of the section (can be itself)
     * @return \Quicklime\Cms\Page
     */
    public function getIndex()
    {
        if ($this->isIndex()) {
            return $this;
        }
        return $this->section->getIndex();
    }

    /**
     * Returns the toc of the section
     * @return Quicklime\Cms\Toc
     */
    public function getToc()
    {
        return $this->section->getToc();
    }
}

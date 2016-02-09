<?php

namespace Quicklime\Cms;

class Section extends Resource
{

    /**
     * @var Quicklime\Cms\Page
     */
    protected $index;

    /**
     * @var Quicklime\Cms\Toc
     */
    protected $toc;

    /**
     * Returns the index of the section
     * @return Quicklime\Cms\Page
     */
    public function getIndex()
    {
        if (null === $this->index) {
            $indexPath = ltrim($this->path, '/').'/'.cms('index');
            $this->index = new Page($indexPath, $this->lang);
        }

        return $this->index;
    }

    /**
     * Returns the toc of the section or null if it does not exist
     * @return null|Quicklime\Cms\Toc
     */
    public function getToc()
    {
        if (null === $this->toc) {
            $tocPath = $this->path.cms('toc');
            $toc = new Toc($tocPath, $this->lang);
            $this->toc = $toc->exists() ? $toc : null;
        }

        return $this->toc;
    }

}

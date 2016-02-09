<?php

namespace Quicklime;

use Illuminate\Foundation\Application;

class Quicklime extends Application
{

    /**
     * Add public path and cms path
     * @param string $basePath
     * @param string $publicPath
     * @param string $cmsPath
     */
    public function __construct($basePath, $publicPath, $cmsPath, $vendorPath)
    {
        parent::__construct($basePath);
        $this->instance('path.public', realpath($publicPath));
        $this->instance('path.cms', realpath($cmsPath));
        $this->instance('path.vendor', realpath($vendorPath));
    }

}

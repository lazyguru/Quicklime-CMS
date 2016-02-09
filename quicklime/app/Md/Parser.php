<?php

namespace Quicklime\Md;

use Quicklime\Md\LinkProcessor;
use League\CommonMark\Environment;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Inline\Element\Link as CommonMarkLink;

class Parser extends CommonMarkConverter
{

    public function __construct()
    {
        $env = Environment::createCommonMarkEnvironment();
        $env->addDocumentProcessor(new LinkProcessor);
        parent::__construct([], $env);
    }

}

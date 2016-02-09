<?php

namespace Quicklime\Md;

use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\CompilerInterface;
use Illuminate\View\Compilers\Compiler as ViewCompiler;

use League\CommonMark\CommonMarkConverter;

class Compiler extends ViewCompiler implements CompilerInterface
{

    /**
     * @param Filesystem $files
     * @param string $cachePath
     */
    public function __construct(Filesystem $files, $cachePath)
    {
        parent::__construct($files, $cachePath);
        $this->parser = new Parser;
    }

    /**
     * @param string $path
     * @return void
     */
    public function compile($path)
    {
        $contents = $this->files->get($path);
        $compiled = $this->parser->convertToHtml($contents);

        if (! is_null($this->cachePath)) {
            $this->files->put($this->getCompiledPath($path), $compiled);
        }
    }

}

<?php

namespace Quicklime\Console;

use ReflectionClass;
use Illuminate\Foundation\Console\OptimizeCommand as IFCOptimizeCommand;


/**
 * Override original OptimizeCommand to use correct vendor path
 * which is hard coded in Laravel
 */
class OptimizeCommand extends IFCOptimizeCommand
{

    /**
     * Get the classes that should be combined and compiled.
     *
     * @return array
     */
    protected function getClassFiles()
    {
        $laravel = $this->laravel;

        $app = [ 'path.base' => dirname($laravel['path.vendor']) ];

        $ref = new ReflectionClass(IFCOptimizeCommand::class);
        $core = require dirname($ref->getFileName()).'/Optimize/config.php';

        $files = array_merge($core, $laravel['config']->get('compile.files', []));

        foreach ($laravel['config']->get('compile.providers', []) as $provider) {
            $files = array_merge($files, forward_static_call([$provider, 'compiles']));
        }

        return array_map('realpath', $files);
    }

}

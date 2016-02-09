<?php

namespace Quicklime\Traits;

trait NotFound
{
    protected function notFound() {
        if ('home' === cms('not_found')) {
            return redirect('/', 301);
        }
        abort(404);
    }
}

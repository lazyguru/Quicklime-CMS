<?php

namespace Quicklime\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Quicklime\Cms\Cms;
use Quicklime\Cms\Section;
use Quicklime\Cms\Resource;
use Quicklime\Traits\NotFound;

class CmsController extends Controller
{
    use NotFound;

    /**
     * Show page
     * @param Request $request
     * @param string $path
     * @return Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $cms = new Cms($request);
        $resource = $cms->getResource();

        # Something went wrong when instantiating Cms, redirect to a safe place
        if ($cms->shouldRedirect()) {
            return $cms->redirect();
        }

        # Get the index of the section
        if ($resource->isSection()) {
            return $this->displayIndex($resource);
        }

        # Ok, we can do it
        if ($resource->exists()) {
            return view('page', [
                'contents' => $resource,
                'toc' => $resource->getToc()
            ]);
        }

        # Requested page does not exist, try section of that name
        $section = $cms->section($cms->fullPath().'/');
        if ($section->exists()) {
            return redirect($section->url());
        }

        # We tried all what's possible
        return $this->notFound();
    }

    /**
     * Display the resource
     * @param \Quicklime\Http\Controllers\Resource $resource
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    protected function display(Resource $resource)
    {
        return view('page', [
            'contents' => $resource,
            'toc' => $resource->getToc()
        ]);
    }

    /**
     * Display the index for the section
     * @param \Quicklime\Http\Controllers\Section $resource
     * @return type
     */
    protected function displayIndex(Section $section)
    {
        # No index. Fail.
        if (!$section->hasIndex()) {
            return $this->notFound();
        }

        # Redirect ?
        if (cms('redirect_to_index')) {
            $indexUrl = $section->fullPath().cms('index');
            return redirect($indexUrl, 301);
        }

        # Display it
        return $this->display($section->getIndex());
    }

}

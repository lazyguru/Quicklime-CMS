<?php

namespace Quicklime\Md;

use League\CommonMark\Inline\Element\Link;
use League\CommonMark\Block\Element\Document;
use League\CommonMark\DocumentProcessorInterface;

class LinkProcessor implements DocumentProcessorInterface
{

    /**
     * @param League\CommonMark\Block\Element\Document $document
     * @return void
     */
    public function processDocument(Document $document)
    {
        $walker = $document->walker();
        while ($event = $walker->next()) {
            $node = $event->getNode();

            // Only stop at Link nodes when we first encounter them
            if (!($node instanceof Link) || !$event->isEntering()) {
                continue;
            }

            $url = $node->getUrl();
            if (\Quicklime\Link::isExternal($url)) {
                $node->data['attributes']['class'] = 'external-link';
            }
        }
    }

}

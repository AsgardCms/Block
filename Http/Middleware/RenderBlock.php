<?php

namespace Modules\Block\Http\Middleware;

use Illuminate\Http\Response;
use Modules\Block\Repositories\BlockRepository;

class RenderBlock
{
    /** @var BlockRepository */
    private $blockRepository;

    public function __construct(BlockRepository $blockRepository)
    {
        $this->blockRepository = $blockRepository;
    }

    public function handle($request, \Closure $next)
    {
        /** @var Response $response */
        $response = $next($request);

        // do not replace shortcodes and render blocks on backend
        if (app('asgard.onBackend') === true) {
            return $response;
        }

        // if this is not a standard Response, return right away
        if (! $response instanceof Response) {
            return $response;
        }

        $response->setContent($this->replaceShortcodes($response->getContent()));

        return $response;
    }

    /**
     * replaces all block shortcodes from the response HTML with the actual block body
     *
     * @param  string  $html
     *
     * @return string
     */
    private function replaceShortcodes($html)
    {
        preg_match_all('/\[\[BLOCK\((.*)\)\]\]/U', $html, $matches);
        $replaceBlocks = [];
        foreach ($matches[1] as $blockIndex => $blockName) {
            // prevent loading same block twice
            if (isset($replaceBlocks[$matches[0][$blockIndex]])) {
                continue;
            }

            $replaceBlocks[$matches[0][$blockIndex]] = $this->blockRepository->get($blockName);
        }

        return str_replace(array_keys($replaceBlocks), $replaceBlocks, $html);
    }
}

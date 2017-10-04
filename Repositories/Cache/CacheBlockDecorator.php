<?php

namespace Modules\Block\Repositories\Cache;

use Modules\Block\Repositories\BlockRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheBlockDecorator extends BaseCacheDecorator implements BlockRepository
{
    public function __construct(BlockRepository $block)
    {
        parent::__construct();
        $this->entityName = 'block.blocks';
        $this->repository = $block;
    }

    /**
     * Get all online blocks in the given language
     * @param string $lang
     * @return object
     */
    public function allOnlineInLang($lang)
    {
        return $this->cache
            ->tags([$this->entityName, 'global'])
            ->remember(
                "{$this->locale}.{$this->entityName}.allOnlineInLang",
                $this->cacheTime,
                function () use ($lang) {
                    return $this->repository->allOnlineInLang($lang);
                }
            );
    }

    /**
     * Get a block by its name if it's online
     * @param string $name
     * @return object
     */
    public function get($name)
    {
        return $this->cache
            ->tags([$this->entityName, 'global'])
            ->remember(
                "{$this->locale}.{$this->entityName}.get.{$name}",
                $this->cacheTime,
                function () use ($name) {
                    return $this->repository->get($name);
                }
            );
    }
}

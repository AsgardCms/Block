<?php namespace Modules\Block\Repositories\Cache;

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
}

<?php

namespace Modules\Block\Facades;

use Illuminate\Support\Facades\Facade;
use Modules\Block\Repositories\BlockRepository;

class BlockFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return BlockRepository::class;
    }
}

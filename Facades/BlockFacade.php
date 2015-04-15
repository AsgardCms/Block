<?php namespace Modules\Block\Facades;

use Illuminate\Support\Facades\Facade;

class BlockFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Modules\Block\Repositories\BlockRepository';
    }
}

<?php

namespace Modules\Block\Events;

use Modules\Block\Entities\Block;
use Modules\Core\Contracts\EntityIsChanging;
use Modules\Core\Events\AbstractEntityHook;

class BlockIsUpdating extends AbstractEntityHook implements EntityIsChanging
{
    /**
     * @var Block
     */
    private $block;

    public function __construct(Block $block, array $data)
    {
        parent::__construct($data);
        $this->block = $block;
    }

    /**
     * @return Block
     */
    public function getBlock()
    {
        return $this->block;
    }
}

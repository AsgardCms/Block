<?php

namespace Modules\Block\Events;

use Modules\Block\Entities\Block;

class BlockWasUpdated
{
    /**
     * @var Block
     */
    public $block;
    /**
     * @var array The posted data through the form request
     */
    public $data;

    public function __construct(Block $block, array $data)
    {
        $this->block = $block;
        $this->data = $data;
    }
}

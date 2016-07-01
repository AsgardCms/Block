<?php

namespace Modules\Block\Events;

class BlockWasCreated
{
    /**
     * @var
     */
    public $blockId;
    /**
     * @var array The posted data through the form request
     */
    public $data;

    public function __construct($blockId, array $data)
    {
        $this->blockId = $blockId;
        $this->data = $data;
    }
}

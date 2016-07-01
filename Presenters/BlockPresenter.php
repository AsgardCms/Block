<?php

namespace Modules\Block\Presenters;

use Laracasts\Presenter\Presenter;

class BlockPresenter extends Presenter
{
    /**
     * Get a bootstrap label of the block is online or offline
     * @return string
     */
    public function onlineLabel()
    {
        if ($this->entity->online) {
            return '<span class="label label-success">Online</span>';
        }

        return '<span class="label label-default">Offline</span>';
    }
}

<?php

namespace Modules\Block\Events;

use Modules\Core\Contracts\EntityIsChanging;
use Modules\Core\Events\AbstractEntityHook;

class BlockIsCreating extends AbstractEntityHook implements EntityIsChanging
{
}

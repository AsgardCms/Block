<?php

namespace Modules\Block\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Block\Events\BlockContentIsRendering;

class BlockTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['online', 'body'];
    protected $table = 'block__blocks_translations';

    public function getBodyAttribute($body)
    {
        event($event = new BlockContentIsRendering($body));

        return $event->getBody();
    }
}

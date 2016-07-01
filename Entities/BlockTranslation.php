<?php

namespace Modules\Block\Entities;

use Illuminate\Database\Eloquent\Model;

class BlockTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['online', 'body'];
    protected $table = 'block__blocks_translations';
}

<?php namespace Modules\Block\Entities;

use Illuminate\Database\Eloquent\Model;

class BlockTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['status', 'body'];
    protected $table = 'block__blocks_translations';
}

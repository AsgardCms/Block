<?php namespace Modules\Block\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use Translatable;

    protected $table = 'block__blocks';
    public $translatedAttributes = ['online', 'body'];
    protected $fillable = ['name', 'online', 'body'];
    protected $casts = [
        'online' => 'bool',
    ];
}

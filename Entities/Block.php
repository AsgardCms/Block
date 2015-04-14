<?php namespace Modules\Block\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use Translatable;

    protected $table = 'block__blocks';
    public $translatedAttributes = ['status', 'body'];
    protected $fillable = ['name', 'status', 'body'];
}

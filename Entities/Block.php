<?php namespace Modules\Block\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Block extends Model
{
    use Translatable, PresentableTrait;

    protected $presenter = 'Modules\Block\Presenters\BlockPresenter';
    protected $table = 'block__blocks';
    public $translatedAttributes = ['online', 'body'];
    protected $fillable = ['name', 'online', 'body'];
    protected $casts = [
        'online' => 'bool',
    ];
}

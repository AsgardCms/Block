<?php

namespace Modules\Block\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

/**
 * Class Block
 * @property string $name
 * @property bool $online
 * @property string $body
 * @property string $shortcode
 */
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

    public function __call($method, $parameters)
    {
        #i: Convert array to dot notation
        $config = implode('.', ['asgard.block.config.relations', $method]);

        #i: Relation method resolver
        if (config()->has($config)) {
            $function = config()->get($config);

            return $function($this);
        }

        #i: No relation found, return the call to parent (Eloquent) to handle it.
        return parent::__call($method, $parameters);
    }

    public function getShortcodeAttribute()
    {
        return sprintf('[[BLOCK(%s)]]', $this->name);
    }
}

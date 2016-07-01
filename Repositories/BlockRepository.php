<?php

namespace Modules\Block\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface BlockRepository extends BaseRepository
{
    /**
     * Get all online blocks in the given language
     * @param string $lang
     * @return object
     */
    public function allOnlineInLang($lang);

    /**
     * Get a block by its name if it's online
     * @param string $name
     * @return object
     */
    public function get($name);
}

<?php namespace Modules\Block\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface BlockRepository extends BaseRepository
{
    /**
     * Get all online blocks in the given language
     * @param string $lang
     * @return object
     */
    public function allOnlineInLang($lang);
}

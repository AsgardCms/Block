<?php namespace Modules\Block\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use Modules\Block\Repositories\BlockRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentBlockRepository extends EloquentBaseRepository implements BlockRepository
{
    /**
     * Get all online blocks in the given language
     * @param string $lang
     * @return object
     */
    public function allOnlineInLang($lang)
    {
        return $this->model->whereHas('translations', function (Builder $q) use ($lang) {
            $q->where('locale', "$lang");
            $q->where('online', true);
        })->with('translations')->orderBy('created_at', 'DESC')->get();
    }
}

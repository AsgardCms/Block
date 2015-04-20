<?php namespace Modules\Block\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Modules\Block\Repositories\BlockRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentBlockRepository extends EloquentBaseRepository implements BlockRepository
{
    /**
     * @param mixed $data
     * @return mixed
     */
    public function create($data)
    {
        $this->normalize($data);

        return $this->model->create($data);
    }

    /**
     * @param $model
     * @param  array  $data
     * @return object
     */
    public function update($model, $data)
    {
        $this->normalize($data);

        $model->update($data);

        return $model;
    }

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

    /**
     * Get a block by its name if it's online
     * @param string $name
     * @return object
     */
    public function get($name)
    {
        $lang = $this->getCurrentLocale();

        return $this->model->whereHas('translations', function (Builder $q) use ($lang) {
            $q->where('locale', "$lang");
            $q->where('online', true);
        })->with('translations')->whereName($name)->firstOrFail();
    }

    /**
     * Get the current application locale
     * @return string
     */
    private function getCurrentLocale()
    {
        return App::getLocale();
    }

    /**
     * Normalize the request data
     * @param array $data
     */
    private function normalize(array &$data)
    {
        $data['name'] = str_slug($data['name']);
    }
}

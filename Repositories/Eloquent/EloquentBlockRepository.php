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
     * @param  array $data
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
        $data['name'] = $this->makeNameUnique($data['name']);
    }

    /**
     * Make the name unique by appending a counter
     * @param string $slug
     * @return string
     */
    private function makeNameUnique($slug)
    {
        $slug = str_slug($slug);

        $list = $this->getExistingSlugs($slug);

        if (
            $this->isEmptyArray($list) ||
            ! $this->isSlugInList($slug, $list) ||
            ($this->isForModel($list) && $this->slugIsInList($slug, $list))
        ) {
            return $slug;
        }

        // map our list to keep only the increments
        $len = strlen($slug.'-');

        array_walk($list, function(&$value, $key) use ($len)
        {
            $value = intval(substr($value, $len));
        });

        return $slug . '-' . $this->findHighestIncrement($list);
    }

    /**
     * Get the existing models matching the given slug
     * @param string $slug
     * @return array
     */
    protected function getExistingSlugs($slug)
    {
        $query = $this->model->where('name', 'LIKE', $slug . '%');

        $list = $query->lists('name', $this->model->getKeyName());

        return $list;
    }

    /**
     * Check if given array is empty
     * @param array $list
     * @return bool
     */
    private function isEmptyArray(array $list)
    {
        return count($list) === 0;
    }

    /**
     * Check if the given slug is present in the given array
     * @param string $slug
     * @param array $list
     * @return bool
     */
    private function isSlugInList($slug, array $list)
    {
        return in_array($slug, $list);
    }

    /**
     * Check if we have our model
     * @param $list
     * @return bool
     */
    private function isForModel($list)
    {
        return array_key_exists($this->model->getKey(), $list);
    }

    /**
     * Check if the given slug is in the given list
     * @param string $slug
     * @param array $list
     * @return bool
     */
    private function slugIsInList($slug, array $list)
    {
        return $list[$this->model->getKey()] === $slug;
    }

    /**
     * @return mixed
     */
    private function findHighestIncrement($list)
    {
        rsort($list);
        $increment = reset($list) + 1;
        return $increment;
    }
}

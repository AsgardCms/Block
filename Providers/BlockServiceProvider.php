<?php namespace Modules\Block\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Modules\Block\Entities\Block;
use Modules\Block\Repositories\Cache\CacheBlockDecorator;
use Modules\Block\Repositories\Eloquent\EloquentBlockRepository;

class BlockServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->registerFacade();
    }

    /**
     * Get the services provided by the provider.
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Block\Repositories\BlockRepository',
            function () {
                $repository = new EloquentBlockRepository(new Block());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new CacheBlockDecorator($repository);
            }
        );
    }

    private function registerFacade()
    {
        $aliasLoader = AliasLoader::getInstance();
        $aliasLoader->alias('Block', 'Modules\Block\Facades\BlockFacade');
    }
}

<?php

namespace Modules\Block\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Modules\Block\Entities\Block;
use Modules\Block\Events\Handlers\RegisterBlockSidebar;
use Modules\Block\Facades\BlockFacade;
use Modules\Block\Repositories\Cache\CacheBlockDecorator;
use Modules\Block\Repositories\Eloquent\EloquentBlockRepository;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Traits\CanGetSidebarClassForModule;
use Modules\Core\Traits\CanPublishConfiguration;

class BlockServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration, CanGetSidebarClassForModule;
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

        $this->app['events']->listen(
            BuildingSidebar::class,
            $this->getSidebarClassForModule('block', RegisterBlockSidebar::class)
        );
    }

    public function boot()
    {
        $this->publishConfig('block', 'permissions');
        $this->publishConfig('block', 'config');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
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
        $aliasLoader->alias('Block', BlockFacade::class);
    }
}

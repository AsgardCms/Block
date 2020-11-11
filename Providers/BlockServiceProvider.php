<?php

namespace Modules\Block\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use Modules\Block\Entities\Block;
use Modules\Block\Events\Handlers\RegisterBlockSidebar;
use Modules\Block\Facades\BlockFacade;
use Modules\Block\Repositories\BlockRepository;
use Modules\Block\Repositories\Cache\CacheBlockDecorator;
use Modules\Block\Repositories\Eloquent\EloquentBlockRepository;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Core\Traits\CanGetSidebarClassForModule;
use Modules\Core\Traits\CanPublishConfiguration;

class BlockServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration, CanGetSidebarClassForModule;

    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app->booting(function () {
            $loader = AliasLoader::getInstance();
            $loader->alias('Block', BlockFacade::class);
        });

        $this->app['events']->listen(
            BuildingSidebar::class,
            $this->getSidebarClassForModule('block', RegisterBlockSidebar::class)
        );

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('blocks', Arr::dot(trans('block::blocks')));
        });
    }

    public function boot()
    {
        $this->publishConfig('block', 'permissions');
        $this->publishConfig('block', 'config');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function registerBindings()
    {
        $this->app->bind(BlockRepository::class, function () {
            $repository = new EloquentBlockRepository(new Block());

            if (! config('app.cache')) {
                return $repository;
            }

            return new CacheBlockDecorator($repository);
        });
    }
}

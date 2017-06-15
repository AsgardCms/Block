<?php

namespace Modules\Block\Tests\Integration;

use Maatwebsite\Sidebar\SidebarServiceProvider;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Mcamara\LaravelLocalization\LaravelLocalizationServiceProvider;
use Modules\Block\Facades\BlockFacade;
use Modules\Block\Providers\BlockServiceProvider;
use Modules\Block\Repositories\BlockRepository;
use Modules\Core\Providers\CoreServiceProvider;
use Nwidart\Modules\LaravelModulesServiceProvider;
use Orchestra\Testbench\TestCase;

abstract class BaseBlockTest extends TestCase
{
    /**
     * @var BlockRepository
     */
    protected $block;

    public function setUp()
    {
        parent::setUp();

        $this->resetDatabase();

        $this->block = app(BlockRepository::class);
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelModulesServiceProvider::class,
            LaravelLocalizationServiceProvider::class,
            CoreServiceProvider::class,
            BlockServiceProvider::class,
            SidebarServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'LaravelLocalization' => LaravelLocalization::class,
            'Block', BlockFacade::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['path.base'] = __DIR__ . '/..';
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', array(
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ));
        $app['config']->set('translatable.locales', ['en', 'fr']);
    }

    private function resetDatabase()
    {
        // Makes sure the migrations table is created
        $this->artisan('migrate', [
            '--database' => 'sqlite',
        ]);
        // We empty all tables
        $this->artisan('migrate:reset', [
            '--database' => 'sqlite',
        ]);
        // Migrate
        $this->artisan('migrate', [
            '--database' => 'sqlite',
        ]);
    }
}

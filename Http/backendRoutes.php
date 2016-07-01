<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->bind('block', function ($id) {
    return app(\Modules\Block\Repositories\BlockRepository::class)->find($id);
});
$router->group(['prefix' => '/block'], function (Router $router) {
    $router->get('blocks', [
        'as' => 'admin.block.block.index',
        'uses' => 'BlockController@index',
        'middleware' => 'can:block.blocks.index',
    ]);
    $router->get('blocks/create', [
        'as' => 'admin.block.block.create',
        'uses' => 'BlockController@create',
        'middleware' => 'can:block.blocks.create',
    ]);
    $router->post('blocks', [
        'as' => 'admin.block.block.store',
        'uses' => 'BlockController@store',
        'middleware' => 'can:block.blocks.create',
    ]);
    $router->get('blocks/{block}/edit', [
        'as' => 'admin.block.block.edit',
        'uses' => 'BlockController@edit',
        'middleware' => 'can:block.blocks.edit',
    ]);
    $router->put('blocks/{block}', [
        'as' => 'admin.block.block.update',
        'uses' => 'BlockController@update',
        'middleware' => 'can:block.blocks.edit',
    ]);
    $router->delete('blocks/{block}', [
        'as' => 'admin.block.block.destroy',
        'uses' => 'BlockController@destroy',
        'middleware' => 'can:block.blocks.destroy',
    ]);
});

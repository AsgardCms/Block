<?php

$router->bind('block', function ($id) {
    return app(\Modules\Block\Repositories\BlockRepository::class)->find($id);
});
$router->group(['prefix' => '/block'], function () {
    get('blocks', [
        'as' => 'admin.block.block.index',
        'uses' => 'BlockController@index',
        'middleware' => 'can:block.blocks.index',
    ]);
    get('blocks/create', [
        'as' => 'admin.block.block.create',
        'uses' => 'BlockController@create',
        'middleware' => 'can:block.blocks.create',
    ]);
    post('blocks', [
        'as' => 'admin.block.block.store',
        'uses' => 'BlockController@store',
        'middleware' => 'can:block.blocks.store',
    ]);
    get('blocks/{block}/edit', [
        'as' => 'admin.block.block.edit',
        'uses' => 'BlockController@edit',
        'middleware' => 'can:block.blocks.edit',
    ]);
    put('blocks/{block}', [
        'as' => 'admin.block.block.update',
        'uses' => 'BlockController@update',
        'middleware' => 'can:block.blocks.update',
    ]);
    delete('blocks/{block}', [
        'as' => 'admin.block.block.destroy',
        'uses' => 'BlockController@destroy',
        'middleware' => 'can:block.blocks.destroy',
    ]);
});

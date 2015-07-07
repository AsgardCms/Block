<?php

$router->bind('blocks', function ($id) {
    return app('Modules\Block\Repositories\BlockRepository')->find($id);
});

$router->group(['prefix' =>'/block'], function () {
    get('blocks', ['as' => 'admin.block.block.index', 'uses' => 'BlockController@index']);
    get('blocks/create', ['as' => 'admin.block.block.create', 'uses' => 'BlockController@create']);
    post('blocks', ['as' => 'admin.block.block.store', 'uses' => 'BlockController@store']);
    get('blocks/{blocks}/edit', ['as' => 'admin.block.block.edit', 'uses' => 'BlockController@edit']);
    put('blocks/{blocks}', ['as' => 'admin.block.block.update', 'uses' => 'BlockController@update']);
    delete('blocks/{blocks}', ['as' => 'admin.block.block.destroy', 'uses' => 'BlockController@destroy']);
});

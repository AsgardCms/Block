<?php

$router->bind('block', function ($id) {
    return app(\Modules\Block\Repositories\BlockRepository::class)->find($id);
});

$router->group(['prefix' =>'/block'], function () {
    get('blocks', ['as' => 'admin.block.block.index', 'uses' => 'BlockController@index']);
    get('blocks/create', ['as' => 'admin.block.block.create', 'uses' => 'BlockController@create']);
    post('blocks', ['as' => 'admin.block.block.store', 'uses' => 'BlockController@store']);
    get('blocks/{block}/edit', ['as' => 'admin.block.block.edit', 'uses' => 'BlockController@edit']);
    put('blocks/{block}', ['as' => 'admin.block.block.update', 'uses' => 'BlockController@update']);
    delete('blocks/{block}', ['as' => 'admin.block.block.destroy', 'uses' => 'BlockController@destroy']);
});

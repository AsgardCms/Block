<?php

use Illuminate\Routing\Router;

/** @var Router $router */

$router->group(['prefix' =>'/block'], function (Router $router) {
        $router->bind('blocks', function ($id) {
            return app('Modules\Block\Repositories\BlockRepository')->find($id);
        });
        $router->resource('blocks', 'BlockController', ['except' => ['show'], 'names' => [
            'index' => 'admin.block.block.index',
            'create' => 'admin.block.block.create',
            'store' => 'admin.block.block.store',
            'edit' => 'admin.block.block.edit',
            'update' => 'admin.block.block.update',
            'destroy' => 'admin.block.block.destroy',
        ]]);
// append

});

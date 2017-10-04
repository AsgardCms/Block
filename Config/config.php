<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Partials to include on page views
    |--------------------------------------------------------------------------
    | List the partials you wish to include on the different type page views
    | The content of those fields well be caught by the PageWasCreated and PageWasEdited events
    */
    'partials' => [
        'translatable' => [
            'create' => [],
            'edit' => [],
        ],
        'normal' => [
            'create' => [],
            'edit' => [],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Dynamic relations
    |--------------------------------------------------------------------------
    | Add relations that will be dynamically added to the Block entity
    */
    'relations' => [
//        'extension' => function ($self) {
//            return $self->belongsTo(BlockExtension::class, 'id', 'block_id')->first();
//        }
    ],

    /*
    |--------------------------------------------------------------------------
    | Set the sidebar position of the block menu item
    |--------------------------------------------------------------------------
    */
    'sidebar-position' => 15,
    /*
    |--------------------------------------------------------------------------
    | Custom Sidebar Class
    |--------------------------------------------------------------------------
    | If you want to customise the admin sidebar ordering or grouping
    | You can define your own sidebar class for this module.
    | No custom sidebar: null
    */
    'custom-sidebar' => null,
];

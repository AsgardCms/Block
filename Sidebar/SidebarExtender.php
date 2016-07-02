<?php

namespace Modules\Block\Sidebar;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\User\Contracts\Authentication;

class SidebarExtender implements \Maatwebsite\Sidebar\SidebarExtender
{
    /**
     * @var Authentication
     */
    protected $auth;

    /**
     * @param Authentication $auth
     *
     * @internal param Guard $guard
     */
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @param Menu $menu
     *
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('block::blocks.title.blocks'), function (Item $item) {
                $item->authorize(
                    $this->auth->hasAccess('block.blocks.index')
                );
                $item->icon('fa fa-cube');
                $item->weight(0);
                $item->append('admin.block.block.create');
                $item->route('admin.block.block.index');
                $item->authorize(
                    $this->auth->hasAccess('block.blocks.index')
                );
            });
        });

        return $menu;
    }
}

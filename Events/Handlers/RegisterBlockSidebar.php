<?php

namespace Modules\Block\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Sidebar\AbstractAdminSidebar;

class RegisterBlockSidebar extends AbstractAdminSidebar
{
    /**
     * Method used to define your sidebar menu groups and items
     * @param Menu $menu
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
                $item->weight(config('asgard.block.config.sidebar-position', 15));
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

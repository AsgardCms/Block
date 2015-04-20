<?php namespace Modules\Block\Composers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;
use Modules\Core\Composers\BaseSidebarViewComposer;

class SidebarViewComposer extends BaseSidebarViewComposer
{
    public function compose(View $view)
    {
        $view->sidebar->group(trans('core::sidebar.content'), function (SidebarGroup $group) {
            $group->addItem(trans('block::blocks.title.blocks'), function (SidebarItem $item) {
                $item->authorize(
                    $this->auth->hasAccess('block.blocks.index')
                );
                $item->icon = 'fa fa-cube';
                $item->weight = 0;
                $item->append('admin.block.block.create');
                $item->route('admin.block.block.index');
                $item->authorize(
                    $this->auth->hasAccess('block.blocks.index')
                );
            });
        });
    }
}

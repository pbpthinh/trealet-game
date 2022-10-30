<?php
namespace Vanguard\Support\Plugins;

use Vanguard\Plugins\Plugin;
use Vanguard\Support\Sidebar\Item;

class MyTrealets extends Plugin
{
    public function sidebar()
    {
        return Item::create(__('My Trealets'))
            ->route('my-trealets')
            ->icon('fas fa-users')
            ->active("my-trealets*");
//            ->permissions('users.manage');
    }
}
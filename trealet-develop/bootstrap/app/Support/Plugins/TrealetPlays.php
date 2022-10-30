<?php
namespace Vanguard\Support\Plugins;

use Vanguard\Plugins\Plugin;
use Vanguard\Support\Sidebar\Item;

class TrealetPlays extends Plugin
{
    public function sidebar()
    {
        return Item::create(__('Trealet Plays'))
            ->route('trealet-plays')
            ->icon('fas fa-users')
            ->active("trealet-plays*");
//            ->permissions('users.manage');
    }
}
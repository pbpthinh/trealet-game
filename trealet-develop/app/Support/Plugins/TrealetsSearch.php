<?php
namespace Vanguard\Support\Plugins;

use Vanguard\Plugins\Plugin;
use Vanguard\Support\Sidebar\Item;

class TrealetsSearch extends Plugin
{
    public function sidebar()
    {
        return Item::create(__('Search'))
            ->route('trealets-search')
            ->icon('fas fa-search')
            ->active('/');
    }
}
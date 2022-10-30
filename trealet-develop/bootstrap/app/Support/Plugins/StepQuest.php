<?php
namespace Vanguard\Support\Plugins;

use Vanguard\Plugins\Plugin;
use Vanguard\Support\Sidebar\Item;

class StepQuest extends Plugin
{
    public function sidebar()
    {
        return Item::create(__('Step Quest'))
            ->route('step-quest')
            ->icon('fas fa-users')
            ->active("step-quest*");
//            ->permissions('users.manage');
    }
}
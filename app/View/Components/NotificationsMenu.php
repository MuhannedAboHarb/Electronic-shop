<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class NotificationsMenu extends Component
{
    public $notifications ;
    public $unread ;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $user = Auth::user();                       //take()
        $this->notifications= $user->notifications()->limit(6)->get();
        $this->unread= $user->unreadNotifications()->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.notifications-menu');
    }
}

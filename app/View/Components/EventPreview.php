<?php

namespace App\View\Components;

use App\Models\Evenement;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EventPreview extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Evenement $evenement)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.event-preview');
    }
}

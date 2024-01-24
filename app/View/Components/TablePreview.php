<?php

namespace App\View\Components;

use App\Models\Table;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TablePreview extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Table $table, public bool $showDate = false)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table-preview');
    }
}

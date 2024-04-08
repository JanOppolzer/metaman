<?php

namespace App\View\Components\FormTable;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BodyCell extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-table.body-cell');
    }
}

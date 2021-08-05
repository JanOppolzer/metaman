<?php

namespace App\View\Components\Buttons;

use App\Models\Entity;
use Illuminate\View\Component;

class HideFromDiscovery extends Component
{
    public $entity;
    public $target;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Entity $entity, string $target)
    {
        $this->entity = $entity;
        $this->target = $target;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.buttons.hide-from-discovery');
    }
}
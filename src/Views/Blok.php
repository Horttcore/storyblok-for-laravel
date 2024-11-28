<?php

namespace RalfHortt\StoryblokForLaravel\Views;

use Illuminate\View\Component;
use Illuminate\View\View;

class Blok extends Component
{
    public array $blok;

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('components.blok');
    }
}

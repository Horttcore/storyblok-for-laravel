<?php
namespace RalfHortt\StoryblokForLaravel\Views;

use Illuminate\View\Component;
use Illuminate\View\View;

class Bloks extends Component {
    public array $blok;

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('components.bloks');
    }
}

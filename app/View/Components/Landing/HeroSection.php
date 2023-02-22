<?php

namespace App\View\Components\Landing;

use Illuminate\View\Component;

class HeroSection extends Component
{
    public $title, $subtitle, $details, $cardtitle;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $subtitle, $details, $cardtitle)
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->details = $details;
        $this->cardtitle = $cardtitle;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.landing.hero-section');
    }
}
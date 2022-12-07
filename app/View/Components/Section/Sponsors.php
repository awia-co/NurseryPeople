<?php

namespace App\View\Components\Section;


use Illuminate\View\Component;

class Sponsors extends Component
{
    public $sponsors;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->sponsors = $this->getSponsors();
    }



    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.section.sponsors');
    }

    protected function getSponsors()
    {
        return \App\Models\Company::where('is_featured', true)->inRandomOrder()->take(3)->get();;
    }
}

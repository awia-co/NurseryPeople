<?php

namespace App\View\Components\Section;

use Illuminate\View\Component;

class TwoColumn extends Component
{
    public string $title;
    public string $subtitle;
    public string $imgsrc;
    public string $imgcaption;
    public bool $imageRight;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $subtitle, $imgsrc = "/images/thundercloud-plum-photo.jpg", $imgcaption = "Thundercloud plum flowers.", $imageRight = true)
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->imgsrc = $imgsrc;
        $this->imgcaption = $imgcaption;
        $this->imageRight = $imageRight;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.section.two-column');
    }
}

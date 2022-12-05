<?php

namespace App\View\Components\Section;

use Illuminate\View\Component;

class TwoColumn extends Component
{
    public string $title;
    public string $subtitle;
    public string $imagesrc;
    public string $imagecaption;
    public bool $imageRight;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $subtitle, $imagesrc = "/images/thundercloud-plum-photo.jpg", $imagecaption = "Thundercloud plum flowers.", $imageRight = true)
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->imagesrc = $imagesrc;
        $this->imagecaption = $imagecaption;
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

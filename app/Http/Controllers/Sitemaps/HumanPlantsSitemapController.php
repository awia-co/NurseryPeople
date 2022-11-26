<?php

namespace App\Http\Controllers\Sitemaps;

use App\Http\Controllers\Controller;
use App\Models\Plant;
use Illuminate\Http\Request;

class HumanPlantsSitemapController extends Controller
{
    public function index()
    {
        $alphas = range('a', 'z');

        return view('.link_sitemap.plants.index', ['alphas' => $alphas]);
    }

    public function show($letter)
    {
        $plants = Plant::where('slug', 'LIKE', "$letter%")->orderBy('name', 'asc')->get();

        return view('link_sitemap.plants.show', [
            'plants' => $plants, 'letter' => $letter,
        ]);
    }
}

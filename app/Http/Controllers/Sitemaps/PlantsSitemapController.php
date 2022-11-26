<?php

namespace App\Http\Controllers\Sitemaps;

use App\Http\Controllers\Controller;
use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlantsSitemapController extends Controller
{
    public function index()
    {
        $alphas = range('a', 'z');

        return response()->view('sitemap.plants.index', [
            'alphas' => $alphas,
        ])->header('Content-Type', 'text/xml');
    }

    public function show($letter)
    {
        $plants = Plant::where('slug', 'LIKE', "$letter%")->get();

        return response()->view('sitemap.plants.show', [
            'plants' => $plants,
        ])->header('Content-Type', 'text/xml');
    }
}

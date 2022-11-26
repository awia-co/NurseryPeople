<?php

namespace App\Http\Controllers\Sitemaps;

use App\Models\Company;
use App\Http\Controllers\Controller;
use App\Models\Plant;
use App\Models\Post;
use Illuminate\Http\Request;

class HumanSitemapController extends Controller
{
    public function index()
    {
        return view('link_sitemap.index', []);
    }
}

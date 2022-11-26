<?php

namespace App\Http\Controllers\Sitemaps;

use App\Models\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HumanNurseriesSitemapController extends Controller
{
    public function index()
    {
        $nurseries = Company::where('is_nursery', true)->orderBy('name', 'asc')->get();

        return view('link_sitemap.nurseries.index', ['nurseries' => $nurseries]);
    }
}

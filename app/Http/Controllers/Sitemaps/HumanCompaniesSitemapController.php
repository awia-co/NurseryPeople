<?php

namespace App\Http\Controllers\Sitemaps;

use App\Models\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HumanCompaniesSitemapController extends Controller
{
    public function index()
    {
        $companies = Company::where('is_nursery', false)->orderBy('name', 'asc')->get();

        return view('link_sitemap.companies.index', ['companies' => $companies]);
    }
}

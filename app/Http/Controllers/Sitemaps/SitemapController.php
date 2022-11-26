<?php

namespace App\Http\Controllers\Sitemaps;

use App\Models\Company;
use App\Http\Controllers\Controller;
use App\Models\Plant;
use App\Models\Post;

class SitemapController extends Controller
{
    public function index()
    {
        $company = Company::orderBy('updated_at', 'desc')->first();
        $plant = Plant::orderBy('updated_at', 'desc')->first();
        $post = Post::orderBy('updated_at', 'desc')->first();

        return response()->view('sitemap.index', [
            'plant' => $plant,
            'company' => $company,
            'post' => $post,
        ])->header('Content-Type', 'text/xml');
    }

    public function companies()
    {
        $companies = Company::where('is_nursery', false)->get();

        return response()->view('sitemap.companies', [
            'companies' => $companies,
        ])->header('Content-Type', 'text/xml');
    }

    public function nurseries()
    {
        $nurseries = Company::where('is_nursery', true)->get();

        return response()->view('sitemap.nurseries', [
            'nurseries' => $nurseries,
        ])->header('Content-Type', 'text/xml');
    }

    public function posts()
    {
        $posts = Post::all();

        return response()->view('sitemap.posts', [
            'posts' => $posts,
        ])->header('Content-Type', 'text/xml');
    }
}

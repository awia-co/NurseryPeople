<?php

namespace App\Http\Controllers\Sitemaps;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class HumanPostsSitemapController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('.link_sitemap.posts.index', ['posts' => $posts]);
    }
}

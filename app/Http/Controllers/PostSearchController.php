<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Trending;

class PostSearchController extends Controller
{
    public function show()
    {
        if (request()->expectsJson()) {
            return Post::search(request('q'))->paginate(20);
        }
        $trending = Post::latest()->take(5)->get();
        $posts = Post::search(request('q'))->paginate(25);

        return view('.posts.search', [
            'posts' => $posts,
            'term' => request('q'),
            'trending' => $trending,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LockedPostsController extends Controller
{
    public function store(Post $post)
    {
        $post->update(['locked' => true]);
    }

    public function destroy(Post $post)
    {
        $post->update(['locked' => false]);
    }
}

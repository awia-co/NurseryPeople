<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LockedPostController extends Controller
{
    public function store(Post $post)
    {
        $this->authorize('update', $post);

        $post->update(['locked' => true]);
    }

    public function destroy(Post $post)
    {
        $this->authorize('update', $post);
        $post->update(['locked' => false]);
    }
}

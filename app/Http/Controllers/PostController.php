<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Stevebauman\Purify\Facades\Purify;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of posts.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $latest = Post::latest();
        $posts = $latest->paginate(25);
        $trending = $latest->take(5)->get();

        return view('.posts.index', [
            'posts' => $posts,
            'trending' => $trending,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        request()->validate([
            'title' => 'required|spamfree',
            'body' => 'required|spamfree',
        ]);

        $purified = Purify::clean($request->toArray());

        $post = Post::create([
            'user_id' => auth()->id(),
            'title' => $purified['title'],
            'body' => $purified['body'],
        ]);
        $post->subscribe();

        if (request()->wantsJson()) {
            return response($post, 201);
        }

        return redirect($post->path())
            ->with('flash', 'Your post was successfully published.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\View\View
     */
    public function show(Post $post)
    {
        $post->increment('visits');
        $trending = Post::latest()->take(5)->get();

        return view('.posts.show', [
            'post' => $post,
            'trending' => $trending,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Post $post)
    {
        request()->validate([
            'title' => 'required|spamfree',
            'body' => 'required|spamfree',
        ]);

        $purified = Purify::clean($request->toArray());

        $post->update([
            'user_id' => auth()->id(),
            'title' => $purified['title'],
            'body' => $purified['body'],
        ]);

        return redirect($post->path())->with('flash', 'Great! Your post was updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy(Post $post)
    {
        try {
            $this->authorize('update', $post);
        } catch (AuthorizationException $e) {
            return redirect()->back()->with('flash', 'You are not authorized to do this!');
        }
        $post->delete();

        if (request()->wantsJson()) {
            return response([], 204);
        }

        return redirect('/posts')->with('flash', 'Your post was deleted.');
    }
}

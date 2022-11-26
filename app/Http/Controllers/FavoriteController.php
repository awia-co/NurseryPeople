<?php

namespace App\Models\Http\Controllers;

use App\Models\Comment;
use App\Models\Company;
use App\Models\Plant;
use App\Models\Post;
use App\Models\Reply;

class FavoriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function favoriteComment(Comment $comment)
    {
        $comment->favorite();
    }

    public function unfavoriteComment(Comment $comment)
    {
        $comment->unfavorite();
    }

    public function favoritePlant(Plant $plant)
    {
        $plant->favorite();
    }

    public function unfavoritePlant(Plant $plant)
    {
        $plant->unfavorite();
    }

    public function favoriteCompany(Company $company)
    {
        $company->favorite();
    }

    public function unfavoriteCompany(Company $company)
    {
        $company->unfavorite();
    }

    public function favoritePost(Post $post)
    {
        $post->favorite();
    }

    public function unfavoritePost(Post $post)
    {
        $post->unfavorite();
    }
}

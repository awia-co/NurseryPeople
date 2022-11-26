<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;

class UsersController extends Controller
{
    /**
     * Fetch all relevant username.
     *
     * @return mixed
     */
    public function index()
    {
        $search = request('name');
        if ($search == null) {
            return User::take(5)->pluck('slug');
        } else {
            return User::where('name', 'LIKE', "%$search%")
            ->take(5)
            ->pluck('slug');
        }
    }
}

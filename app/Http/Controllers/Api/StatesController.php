<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\State;

class StatesController extends Controller
{
    public function index()
    {
        $search = request('query');

        return State::where('name', 'LIKE', "%$search%")
            ->take(5)
            ->get();
    }
}

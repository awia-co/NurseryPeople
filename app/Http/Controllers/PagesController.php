<?php

namespace App\Http\Controllers;

use App\Models\Plant;

class PagesController extends Controller
{
    public function index()
    {
        $plants = Plant::inRandomOrder()
            ->where('is_featured', true)->take(6)->get();

        return view('home', [
            'plants' => $plants,
        ]);
    }

    public function about()
    {
        return view('about');
    }

    public function privacy()
    {
        return view('privacy_policy');
    }
}

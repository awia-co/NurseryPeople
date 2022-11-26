<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\Request;

class PlantSearchController extends Controller
{
    public function show()
    {
        $search = request('q');
        $plants = Plant::search($search)->paginate(25);

        return view('plants.search.show', ['plants' => $plants, 'search' => $search]);
    }
}

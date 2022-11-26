<?php

namespace App\Http\Controllers;

use App\Models\State;

class StatesController extends Controller
{
    public function show(State $state)
    {
        $companies = $state->companies()->withCount(['plants', 'reviews', 'locations'])->where('is_nursery', true)->orderBy('is_featured', 'desc')->paginate(25);

        return view(
            'companies.states.show',
            [
                'companies' => $companies,
                'state' => $state,
            ]
        );
    }
}

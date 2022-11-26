<?php

namespace App\Http\Controllers;

use App\Models\FeaturedApplicant;
use App\Mail\FeaturedApplicationSubmitted;
use App\Rules\SpamFree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FeaturedController extends Controller
{
    public function create()
    {
        return view('featured-nursery');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'min:4', 'max:255'],
                'company_name' => ['required', 'min::4'],
                'email' => ['required', 'email'],
                'message' => ['required'],
            ]
        );
        $featuredApplication = FeaturedApplicant::create([
            'name' => $request->name,
            'company_name' => $request->company_name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        Mail::to('chris@nurserypeople.com')
            ->send(new FeaturedApplicationSubmitted($featuredApplication));

        return redirect()->back()->with('flash', 'Your nomination was successfully submitted! Thanks so much.');
    }
}

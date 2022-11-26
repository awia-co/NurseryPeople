<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Edit;
use App\Mail\editSuggested;
use App\Rules\NoHtml;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SuggestionController extends Controller
{
    public function suggestCompanyEdit(Request $request, Company $company)
    {
        $this->validate($request, [
            'name' => ['required', 'string', new NoHtml],
            'email' => ['required', 'email', new NoHtml],
            'changes' => ['string', new NoHtml],
        ]);

        $edit = Edit::create([
            'name',
        ]);

        Mail::send(new editSuggested());

        // redirect to back with message
        return redirect()->back()->with('flash', 'Your suggestion was sent. Thanks so much for your contribution!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Company;
use App\Mail\ContactFormSubmitted;
use App\Mail\SendClaimRequest;
use App\Rules\SpamFree;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ClaimController extends Controller
{
    public function store(Request $request, Company $company)
    {
        $request->validate([
            'reason' => ['required', new SpamFree()],
        ]);
        $user = auth()->user();
        $claim = Claim::create([
            'user_id' => $user->id,
            'company_id' => $company->id,
            'company_name' => $company->name,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'reason' => $request->reason,
        ]);
        Mail::to('chris@nurserypeople.com')->send(new SendClaimRequest($claim));

        return redirect()->back()->with('flash', 'Your request to claim this company was successful!');
    }
}

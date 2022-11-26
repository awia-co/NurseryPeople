<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        return view('user/profile', [
            'user' => $user,
        ]);
    }

    public function update(Request $request)
    {
        request()->validate([
            'name' => 'required|spamfree',
            'email' => 'required|email',
            'bio' => 'spamfree',
        ]);
        $user = Auth()->user();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->bio = $request->bio;
        $user->save();

        return redirect('/profiles/' . $user->slug)->with('flash', 'Your Profile was successfully updated!');
    }

    public function addPlant()
    {
        return view('user/addplant');
    }

    public function viewCompanies()
    {
        $user = Auth::user();
        $companies = $user->companies;

        return view('user/companies', [
            'companies' => $companies,
        ]);
    }

    public function editCompany(Company $company)
    {
        $this->authorize('update', $company);

        $plants = $company->plants()->paginate(10);

        return view('user/editCompany', [
            'company' => $company,
        ]);
    }

    public function contribute()
    {
        return view('user/contribute');
    }

    public function security()
    {
        return view('user/security');
    }
}

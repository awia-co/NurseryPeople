<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanySearchController extends Controller
{
    public function show()
    {
        $search = request('q');
        $companies = Company::search($search)->orderBy('is_featured', 'desc')->paginate(25);

        return view('companies.search.show', ['companies' => $companies, 'search' => $search]);
    }
}

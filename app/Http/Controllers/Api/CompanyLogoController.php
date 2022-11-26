<?php

namespace App\Http\Controllers\Api;

use App\Models\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyLogoController extends Controller
{
    public function store(Company $company)
    {
        $this->authorize('update', $company);
        request()->validate([
            'logo' => ['required', 'image'],
        ]);

        $company->update([
            'logo_path' => request()->file('logo')->store('logos', 'public'),
        ]);

        return response([], 204);
    }
}

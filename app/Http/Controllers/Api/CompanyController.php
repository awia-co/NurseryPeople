<?php

namespace App\Http\Controllers\Api;

use App\Models\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function update(Company $company, Request $request)
    {
        $request->validate([
            'name' => ['required'],
        ]);

        $company->update([
            'name' => $request->name,
            'website' => $request->website,
            'description' => $request->description,
            'is_wholesale_only' => $request->is_wholesale_only,
        ]);

        return $company->toJson();
    }

    public function destroy(Company $company, Request $request)
    {
        $company->delete();

        return response([], 204);
    }
}

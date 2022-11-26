<?php

namespace App\Http\Controllers\Api;

use App\Models\Company;
use App\Http\Controllers\Controller;
use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CompanyPlantsController extends Controller
{
    public function index(Company $company)
    {
        $plants = $company->plants()
            ->get();

        return $plants;
    }

    public function store(Company $company, Plant $plant)
    {
        if (Gate::allows('update', $company)) {
            $company->plants()->attach($plant);

            return response('Success', 204);
        }
    }

    public function destroy(Company $company, Plant $plant)
    {
        if (Gate::allows('update', $company)) {
            $company->plants()->detach($plant);

            return response('Success', 204);
        }
    }
}

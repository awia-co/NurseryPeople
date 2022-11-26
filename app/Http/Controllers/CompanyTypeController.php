<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CompanyTypeController extends Controller
{
    public function show(Category $companyType)
    {
        $companies = $companyType->companies()
            ->orderBy('is_featured', 'desc')
            ->paginate(25);

        return view(
            '.companies.company_categories.show',
            [
                'companies' => $companies,
                'category' => $companyType,
            ]
        );
    }
}

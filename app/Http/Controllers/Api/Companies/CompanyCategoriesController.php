<?php

namespace App\Http\Controllers\Api\Companies;

use App\Category;
use App\Models\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use function MongoDB\BSON\toJSON;

class CompanyCategoriesController extends Controller
{
    public function index(Company $company)
    {
        $categories = Category::all();
        $selectedcategories = $company->categories()->get();

        return [
            'categories' => $categories,
            'selectedcategories' => $selectedcategories,
        ];
    }

    public function store(Company $company, Category $category)
    {
        $this->authorize('update', $company);

        $company->categories()->attach($category);
    }

    public function destroy(Company $company, Category $category)
    {
        $this->authorize('update', $company);

        $company->categories()->detach($category);
    }
}

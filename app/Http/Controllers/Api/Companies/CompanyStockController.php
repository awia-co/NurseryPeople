<?php

namespace App\Http\Controllers\Api\Companies;

use App\Category;
use App\Models\Company;
use App\Http\Controllers\Controller;
use App\Stock;
use Illuminate\Http\Request;

class CompanyStockController extends Controller
{
    public function index(Company $company)
    {
        $stocks = Stock::all();
        $selectedStocks = $company->stocks()->get();

        return [
            'stocks' => $stocks,
            'selectedStocks' => $selectedStocks,
        ];
    }

    public function store(Company $company, Stock $stock)
    {
        $this->authorize('update', $company);

        $company->stocks()->attach($stock);
    }

    public function destroy(Company $company, Stock $stock)
    {
        $this->authorize('update', $company);

        $company->stocks()->detach($stock);
    }
}
